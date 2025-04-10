<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\ReplyComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyCommentController extends Controller
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
            'content' => 'required|string|max:500',
            'id' => 'required|integer|exists:comments,id',
        ]);
        $user = Auth::user();
        $comment = Comment::find($request->id)->load('task.members');
        if ($comment->task->members->contains('id', $user->id)) {
            return redirect()->back()->with('alert', ['icon' => 'error', 'message' => 'You can not reply your own comment']);
        }
        ReplyComment::create([
            'user_id' => $user->id,
            'content' => $request->content,
            'comment_id' => $request->id,
        ]);

        return redirect()->back()->with('alert', ['icon' => 'success', 'message' => 'Reply comment created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(ReplyComment $replyComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReplyComment $replyComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);
        $user = Auth::user();
        $comment = Comment::find($id)->load('task.members');
        if ($comment->task->members->contains('id', $user->id)) {
            return redirect()->back()->with('alert', ['icon' => 'error', 'message' =>  'You can not update your own comment']);
        }
        $replyComment = ReplyComment::findOrFail($id);
        $replyComment->update([
            'content' => $request->content,
        ]);

        return redirect()->back()->with('alert', ['icon' => 'success', 'message' => 'reply comment updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        $replyComment = ReplyComment::findOrFail($id);
        $replyComment->delete();
        return redirect()->back()->with('alert', ['icon' => 'success', 'message' => 'reply comment deleted successfully']);
    }
}
