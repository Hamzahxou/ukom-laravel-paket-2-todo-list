<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChangeCompletedTaskController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $id)
    {
        $request->validate([
            'completed' => 'required|boolean',
        ]);
        $user = Auth::user();
        $task = Task::where('user_id', $user->id)->findOrFail($id);
        $task->update([
            'completed' => $request->completed ? 0 : 1,
        ]);
        return redirect()->route('todo-lists.index')->with('alert', [
            "icon" => "success",
            'message' => 'Task updated successfully'
        ]);
    }
}
