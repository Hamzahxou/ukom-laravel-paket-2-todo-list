<?php

namespace App\Http\Controllers;

use App\Models\MemberTask;
use App\Models\TagItem;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $tags = TagItem::where('user_id', $user->id)->get()->pluck('name');
        // $todos = Task::where('user_id', $user->id)->with(['tags', 'comments.user', 'members.user'])->get();
        $todos = MemberTask::where('status', "accepted")->where('member_id', $user->id)->with(['task.tags', 'task.comments.user', 'task.members.user', 'task.user'])->get();
        // dd($todos->toArray());
        return view('team.index', compact('tags', 'todos'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MemberTask $memberTask)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MemberTask $memberTask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MemberTask $memberTask)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MemberTask $memberTask)
    {
        //
    }
}
