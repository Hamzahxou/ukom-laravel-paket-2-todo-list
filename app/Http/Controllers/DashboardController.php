<?php

namespace App\Http\Controllers;

use App\Models\TagItem;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $tags = TagItem::where('user_id', $user->id)
            ->get(["id", "name"])
            ->loadCount("tags")
            ->toArray();
        $tasksModel = Task::where('user_id', $user->id)
            ->get(["id", "title", 'priority', 'completed', "progress"]);

        $tasks = $tasksModel->toArray();

        $priority = $tasksModel->countBy('priority');
        $priorityDefult = [
            'low' => 1,
            'medium' => 2,
            'high' => 3
        ];
        $priorities = [];
        foreach ($priorityDefult as $key => $value) {
            $priorities[$key] = $priority->get($value, 0);
        }

        return view('dashboard', compact('tags', 'tasks', 'priorities'));
    }
}
