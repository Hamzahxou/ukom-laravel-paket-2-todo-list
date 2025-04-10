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

        $tasks = Task::where('user_id', $user->id)
            ->get(["id", "title", 'priority', 'completed', "progress"])
            ->toArray();

        return view('dashboard', compact('tags', 'tasks'));
    }
}
