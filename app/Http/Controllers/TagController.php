<?php

namespace App\Http\Controllers;

use App\Models\TagItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $tags = TagItem::where('user_id', $user->id)->with('tags')->get();
        return view('tags.index', compact('tags'));
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
            'name' => ['required', 'string', 'max:255', 'unique:tag_items,name']
        ]);
        $user = Auth::user();
        TagItem::create([
            'name' => $request->name,
            'user_id' => $user->id,
        ]);
        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $request->validate([
            'name' => "required|string|max:255|unique:tag_items,name,{$id},id,user_id,{$user->id}",
        ]);

        $tag = TagItem::where('user_id', $user->id)->findOrFail($id);
        $tag->update([
            'name' => $request->name
        ]);
        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        $tag = TagItem::where('user_id', $user->id)->findOrFail($id);
        $tag->delete();
        return redirect()->route('tags.index');
    }
}
