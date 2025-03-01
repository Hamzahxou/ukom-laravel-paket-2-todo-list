<?php

namespace App\Http\Controllers;

use App\Models\MemberTask;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JoinTaskController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function join(Request $request)
    {
        $request->validate([
            'token' => 'required|string|exists:tasks,token|min:11|max:11',
        ]);
        $user = Auth::user();
        $task = Task::where('token', $request->token)->where('user_id', "!=", $user->id)->first();
        if (!$task) {
            return redirect()->route("todo-teams.index")->with("alert", [
                "icon" => "warning",
                "message" => "you are an owner",
            ]);
        }
        $join = MemberTask::where('member_id', $user->id)->where('task_id', $task->id)->first();
        if (isset($join) && $join->status != "leave") {
            if ($join->status == "rejected") {
                return redirect()->route("todo-teams.index")->with("alert", [
                    "icon" => "error",
                    "message" => "You are not allowed to join this task.",
                ]);
            }
            return redirect()->route("todo-teams.index")->with("alert", [
                "icon" => "error",
                "message" => "Join task already $join->status",
            ]);
        } else if (isset($join) && $join->status == "leave") {
            $join->update([
                "status" => "pending",
            ]);
        } else {
            $join = MemberTask::create([
                'member_id' => $user->id,
                'task_id' => $task->id,
                "status" => "pending",
            ]);
        }
        return redirect()->route("todo-teams.index")->with("alert", [
            "icon" => "success",
            "message" => "Join task pending",
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|string|in:pending,accepted,rejected'
        ]);
        $memberTask = MemberTask::findOrFail($id);
        $memberTask->update([
            "status" => $request->status,
        ]);
        return redirect()->route("todo-lists.index")->with("alert", [
            "icon" => "success",
            "message" => "Join task updated",
        ]);
    }
}
