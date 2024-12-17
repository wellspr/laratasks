<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\ManageFilteringState;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard.home');
})->middleware(['auth', 'verified'])->name('dashboard.home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/* GET: / - Root route */
Route::get("/", [TaskController::class, 'home'])->middleware('auth')->name("home");

/* Tasks lists / Filtering routes */
Route::middleware([ManageFilteringState::class, 'auth'])->group(function () {
    /* GET: /tasks */
    Route::get('/tasks', [TaskController::class, 'index'])->name("tasks.list");

    /* GET: /tasks/all */
    Route::get('/tasks/all', [TaskController::class, 'all'])->name("tasks.list.all");

    /* GET: /tasks/completed */
    Route::get('/tasks/completed', [TaskController::class, 'completed'])->name("tasks.list.completed");

    /* GET: /tasks/search */
    Route::get('/tasks/search', [TaskController::class, 'search'])->name("tasks.list.search");
});

/* View routes */
Route::middleware('auth')->group((function () {
    /* GET: /tasks/create */
    Route::get('/tasks/add', [TaskController::class, 'taskAdd'])->name("tasks.add");

    /* GET: /tasks/{task}/edit */
    Route::get('/tasks/{task}/edit', [TaskController::class, 'taskEdit'])->name("tasks.edit");

    /* GET: /tasks/{task} */
    Route::get("/tasks/{task}", [TaskController::class, 'taskShow'])->name("tasks.show");
}));

/* Actions */
Route::middleware('auth')->group(function () {
    /* POST: /tasks - CREATE a new task */
    Route::post('/tasks', [TaskController::class, 'create'])->name("tasks.create");

    /* PUT: /tasks/{task} - UPDATE a task*/
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name("tasks.update");

    /* DELETE: /tasks/{task} - DELETE a task */
    Route::delete('/tasks/{task}', [TaskController::class, 'delete'] )->name("tasks.destroy");

    /* PATCH: /tasks/{task}/toggle-complete */
    Route::get('/tasks/{task}/toggle-complete', [TaskController::class, 'toggleComplete'])->name("tasks.toggle-complete");
});

require __DIR__.'/auth.php';
