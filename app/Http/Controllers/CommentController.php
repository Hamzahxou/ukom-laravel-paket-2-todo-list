<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'id' => 'required|integer|exists:tasks,id',
            'content' => 'required|string|max:10000',
        ]);
        $user = Auth::user();
        $task = Task::findOrFail($request->id);
        $comment = Comment::create([
            'task_id' => $task->id,
            'user_id' => $user->id,
            'content' => $request->content,
        ]);
        return redirect()->back()->with("alert", [
            "icon" => "success",
            'message' => 'Comment created successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'content' => 'required|string|max:10000',
        ]);
        $user = Auth::user();
        $comment = Comment::where('user_id', $user->id)->findOrFail($id);
        $comment->update([
            'content' => $request->content,
        ]);
        return redirect()->back()->with('alert', [
            "icon" => "success",
            'message' => 'Comment updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        $comment = Comment::where('user_id', $user->id)->findOrFail($id);
        $comment->delete();
        return redirect()->back()->with('alert', [
            "icon" => "success",
            'message' => 'Comment deleted successfully'
        ]);
    }
}
