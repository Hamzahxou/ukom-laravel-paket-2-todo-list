<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\TagItem;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $tags = TagItem::where('user_id', $user->id)->get()->pluck('name');
        $todos = Task::where('user_id', $user->id)->with(['tags']);
        if ($request->input('search') || $request->input('completed') || $request->input('priority')) {
            $todos = $todos->where(function ($query) use ($request) {
                if ($request->input('search')) {
                    $query->where('title', 'like', '%' . $request->input('search') . '%');
                }
                if ($request->input('completed')) {
                    $request->validate([
                        'completed' => ['required', 'in:true,false']
                    ]);
                    $query->where('completed', $request->input('completed'));
                }
                if ($request->input('priority')) {
                    $request->validate([
                        'priority' => ['required', 'integer', 'in:1,2,3']
                    ]);
                    $query->where('priority', $request->input('priority'));
                }
            });
        } else {
            $todos = $todos->orderBy('priority', 'desc');
        }
        $todos = $todos->get();
        $edit = null;
        if ($request->input('edit') && $request->input("id")) {
            $edit = $todos->where('user_id', $user->id)->findOrFail($request->input("id"));
        }
        $todos = $todos->load(['comments.user', 'members.user', 'comments.replyComments.user']);
        // dd($todos->toArray());
        return view('todo.index', compact('tags', 'todos', 'edit'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:10000'],
            'priority' => ['required', 'string', 'max:255', 'in:1,2,3'],
            "tags" => "required",
        ]);
        $user = Auth::user();
        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description ?? null,
            'priority' => $request->priority,
            'user_id' => $user->id,
            "token" => null
        ]);

        $tags = $request->tags;
        $tags = json_decode($tags);
        $tags = array_column($tags, 'value');
        foreach ($tags as $tag) {
            $tagItem = TagItem::where('name', $tag)->first();
            $tagItems = $tagItem;
            if (!$tagItem) {
                $tagItems = TagItem::create([
                    'name' => $tag,
                    'user_id' => $user->id,
                ]);
            }
            Tag::create([
                'tag_item_id' => $tagItems->id,
                'task_id' => $task->id,
            ]);
        }

        return redirect()->route('todo-lists.index')->with('alert', [
            "icon" => "success",
            'message' => 'Task created successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        $todo = Task::where('user_id', $user->id)->where('id', $id)->with(['tags', 'comments.user', 'members.user'])->firstOrFail();
        return view('todo.view', compact('todo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:10000'],
            'priority' => ['required', 'string', 'max:255', 'in:1,2,3'],
            "progress" => ['required', 'integer', 'min:0', 'max:100'],
            "tags" => "required",
        ]);
        $user = Auth::user();
        $task = Task::where('user_id', $user->id)->findOrFail($id);
        $task->update([
            'title' => $request->title,
            'description' => $request->description ?? null,
            'priority' => $request->priority,
            "progress" => $request->progress,
        ]);

        $tagsReq = json_decode($request->tags);
        $tagsNew = array_column($tagsReq, 'value');

        $tags = Tag::where('task_id', $task->id)->with('tagItem')->get();
        $tagsOld = $tags->pluck('tagItem.name')->toArray();

        // 1. Hapus tag lama yang tidak ada di input baru
        $tagsUntukDihapus = array_diff($tagsOld, $tagsNew);
        foreach ($tagsUntukDihapus as $tagHapus) {
            $tagTersedia = TagItem::where('name', $tagHapus)->first();
            if ($tagTersedia) {
                Tag::where('tag_item_id', $tagTersedia->id)
                    ->where('task_id', $task->id)
                    ->delete();
            }
        }

        // 2. Tambahkan tag baru yang belum ada di database
        foreach ($tagsNew as $tag) {
            $tagItem = TagItem::where('name', $tag)->first();
            if (!$tagItem) {
                $tagItem = TagItem::create([
                    'name' => $tag,
                    'user_id' => $user->id,
                ]);
            }

            $tagItems = Tag::where("task_id", $task->id)->where("tag_item_id", $tagItem->id)->first();
            if (!$tagItems) {
                Tag::create([
                    'tag_item_id' => $tagItem->id,
                    'task_id' => $task->id,
                ]);
            }
        }

        return redirect()->route('todo-lists.index')->with('alert', [
            "icon" => "success",
            'message' => 'Task updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        $task = Task::where('user_id', $user->id)->findOrFail($id);
        try {
            $task->delete();
            return redirect()->route('todo-lists.index')->with('alert', [
                "icon" => "success",
                'message' => 'Task deleted successfully'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('alert', [
                "icon" => "error",
                'message' => "Task can't be deleted"
            ]);
        }
    }
}
