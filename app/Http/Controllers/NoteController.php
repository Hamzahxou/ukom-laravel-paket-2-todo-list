<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Tag;
use App\Models\TagItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $notes = Note::where('user_id', $user->id)->with('tags.tagItem')->paginate(5);

        $tags = TagItem::where('user_id', $user->id)->get()->pluck('name');
        return view('note.index', compact('notes', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:10000',
        ]);
        $user = Auth::user();
        $note = Note::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $user->id,
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
                'note_id' => $note->id,
            ]);
        }

        return redirect()->route('notes.index')->with('alert', [
            "icon" => "success",
            'message' => 'Note created successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        $note = Note::where('user_id', $user->id)->findOrFail($id);
        return view('note.show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        $note = Note::where('user_id', $user->id)->with('tags.tagItem')->findOrFail($id);
        $tags = TagItem::where('user_id', $user->id)->get()->pluck('name');
        return view('note.edit', compact('note', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:10000',
        ]);
        $user = Auth::user();
        $note = Note::where('user_id', $user->id)->findOrFail($id);
        $note->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        $tagsReq = json_decode($request->tags);
        $tagsNew = array_column($tagsReq, 'value');

        $tags = Tag::where('note_id', $note->id)->with('tagItem')->get();
        $tagsOld = $tags->pluck('tagItem.name')->toArray();

        // 1. Hapus tag lama yang tidak ada di input baru
        $tagsUntukDihapus = array_diff($tagsOld, $tagsNew);
        foreach ($tagsUntukDihapus as $tagHapus) {
            $tagTersedia = TagItem::where('name', $tagHapus)->first();
            if ($tagTersedia) {
                Tag::where('tag_item_id', $tagTersedia->id)
                    ->where('note_id', $note->id)
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

            $tagItems = Tag::where("note_id", $note->id)->where("tag_item_id", $tagItem->id)->first();
            if (!$tagItems) {
                Tag::create([
                    'tag_item_id' => $tagItem->id,
                    'note_id' => $note->id,
                ]);
            }
        }


        return redirect()->route('notes.index')->with('alert', [
            "icon" => "success",
            'message' => 'Note updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        $note = Note::where('user_id', $user->id)->findOrFail($id);
        $note->delete();
        return redirect()->route('notes.index')->with('alert', [
            "icon" => "success",
            'message' => 'Note deleted successfully'
        ]);
    }
}
