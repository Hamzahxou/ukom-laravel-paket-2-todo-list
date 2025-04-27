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
        $notes = Note::where('user_id', $user->id)->with('tags')->paginate(5);

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
        $tag_items = [];
        foreach ($tags as $tag) {
            $tagItem = TagItem::where('name', $tag)->firstOrCreate([
                'name' => $tag,
                'user_id' => $user->id,
            ]);

            $tag_items[] = $tagItem->id;
        }

        $note->tags()->sync($tag_items);

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

        $tags = json_decode($request->tags);
        $tags = array_column($tags, 'value');
        $tag_items = [];
        foreach ($tags as $tag) {
            $tagItem = TagItem::where('name', $tag)->firstOrCreate([
                'name' => $tag,
                'user_id' => $user->id,
            ]);
            $tag_items[] = $tagItem->id;
        }
        $note->tags()->sync($tag_items);



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
