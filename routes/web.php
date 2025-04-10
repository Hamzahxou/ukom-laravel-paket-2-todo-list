<?php

use App\Http\Controllers\ChangeCompletedTaskController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\JoinTaskController;
use App\Http\Controllers\MemberTaskController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReplyCommentController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::middleware('auth')->group(function () {

    Route::resource('todo-lists', TaskController::class);
    Route::resource('todo-teams', MemberTaskController::class);
    Route::resource('notes', NoteController::class);

    Route::put('todo-complete/{id}', ChangeCompletedTaskController::class)->name('updateCompleted');
    Route::post("join-task", [JoinTaskController::class, "join"])->name('joinTask');
    Route::put("join-task-update/{id}", [JoinTaskController::class, "update"])->name('joinTaskUpdate');

    Route::resource('comments', CommentController::class)->only(['store', 'update', 'destroy']);
    Route::resource('reply-comment', ReplyCommentController::class)->only(['store', 'update', 'destroy']);

    Route::resource('tags', TagController::class);
});


require __DIR__ . '/auth.php';
