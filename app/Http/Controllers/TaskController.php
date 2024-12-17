<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function home() {
        return redirect()->route("tasks.list");
    }

    public function index () {
        $count = Task::latest()->where(['completed' => false, 'user_id' => Auth::id()])->count();

        return view("tasks.list", [
            "count" => $count,
            "tasks" => Task::latest()
                ->where(['completed' => false])
                ->where(['user_id' => Auth::id()])
                ->paginate(10),
        ]);
    }

    public function all () {
        $count = Task::latest()->where(['user_id' => Auth::id()])->count();

        return view("tasks.list", [
            "count" => $count,
            "tasks" => Task::latest()->where(['user_id' => Auth::id()])->paginate(10),
        ]);
    }

    public function completed () {
        $count = Task::latest()->where(['completed' => true])->where(['user_id' => Auth::id()])->count();

        return view("tasks.list", [
            "count" => $count,
            "tasks" => Task::latest()
                ->where(['completed' => true])
                ->where(['user_id' => Auth::id()])
                ->paginate(10),
        ]);
    }

    public function search (Request $request) {
        $searchTerm = $request->input("term");

        $count = Task::latest()
            ->whereLike('title', "%$searchTerm%")
            ->orWhereLike('description', "%$searchTerm%")
            ->orWhereLike('long_description', "%$searchTerm%")
            ->where(['user_id' => Auth::id()])
            ->count();

        return view("tasks.list", [
            "count" => $count,
            "tasks" => Task::latest()
                ->whereLike('title', "%$searchTerm%")
                ->orWhereLike('description', "%$searchTerm%")
                ->orWhereLike('long_description', "%$searchTerm%")
                ->where(['user_id' => Auth::id()])
                ->paginate(10),
        ]);
    }

    public function taskAdd () {
        return view("tasks.add", ['user_id' => Auth::id()]);
    }

    public function taskEdit (Task $task) {
        return view('tasks.edit', ["task" => $task, 'user_id' => Auth::id()]);
    }

    public function taskShow (Task $task) {
        return view("tasks.show", ['task' => $task]);
    }

    /* Action - CREATE new task */
    public function create(TaskRequest $request) {
        $data = $request->validated();
        $task = Task::create($data);

        return redirect()
            ->route("tasks.show", ["task" => $task->id])
            ->with("success", "Task created successfully");
    }

    /* Action UPDATE task */
    public function update (Task $task, TaskRequest $request) {
        $task->update($request->validated());

        return redirect()
            ->route("tasks.show", ["task" => $task->id])
            ->with("success", "Task updated successfully");
    }

    public function delete (Task $task) {
        $task->delete();

        return redirect()
            ->route("tasks.list")
            ->with("success", "Task deleted successfully");
    }

    public function toggleComplete (Task $task) {
        $task->toggleComplete();
        $message = $task->completed ? "Task completed" : "Task marked to redo";

        return redirect()
            ->route("tasks.show", ["task" => $task])
            ->with("success", $message);
    }
}
