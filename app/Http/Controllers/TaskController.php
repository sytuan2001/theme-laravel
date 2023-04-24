<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(TaskService $taskService)
    {
        $tasks = $taskService->getTasks(auth()->id());
        return view('todos.home', compact('tasks'));
    }


    public function create()
    {
        return view('tasks.create', [
            'task' => new Task()
        ]);
    }

    public function store(CreateTaskRequest $request)
    {
        $this->taskService->createTask($request->validated());

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $this->taskService->updateTask($id, $request->all());

        return response()->json(['success' => 'Task updated successfully']);
    }

    public function destroy($id)
    {
        $this->taskService->deleteTask($id);

        return response()->json(['success' => 'Task deleted successfully']);
    }

    public function deleteChecked(Request $request)
    {
        $ids = $request->ids;
        $this->taskService->deleteTasks($ids);

        return response()->json(['success' => "Task delete!"]);
    }

    public function updateStatus(Request $request)
    {
        $taskIds = $request->input('task_id');
        $this->taskService->updateTaskStatus($taskIds);

        return response()->json(['success' => 'Status updated successfully.']);
    }
}
