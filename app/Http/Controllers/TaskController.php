<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Models\Task;
use App\Models\User;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    private TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        $userTasks = $this->taskService->getTasksByUserId(Auth::user()->id);

        $users = User::whereIn('role', ['leader', 'member'])->get();

        return view('todos.home', ['tasks' => $userTasks, 'users' => $users]);
    }

    public function create()
    {
        $users = User::where('role_id', '<', Auth::user()->role_id)->get();
        return view('tasks.create', [
            'task' => new Task(),
            'users' => $users,
            'userId' => Auth::user()->id,
        ]);
    }

    public function store(CreateTaskRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = Auth::user()->name;
        $task = $this->taskService->createTask($data, Auth::user()->id);

        return redirect('/tasks');
    }

    public function update(Request $request, Task $task)
    {
        $this->taskService->updateTask($task->id, $request->all());

        return response()->json(['success' => 'Task updated successfully']);
    }

    public function destroy(Task $task)
    {
        $this->taskService->deleteTask($task->id);

        return response()->json(['success' => 'Task deleted successfully']);
    }

    public function deleteChecked(Request $request)
    {
        $ids = $request->ids;
        $this->taskService->deleteTasks($ids);

        return response()->json(['success' => "Task deleted!"]);
    }

    public function updateStatus(Request $request)
    {
        $taskIds = $request->input('task_id');
        $this->taskService->updateTaskStatus($taskIds);

        return response()->json(['success' => 'Status updated successfully.']);
    }

    public function edit(Task $task)
    {
        $users = User::where('role_id', '<', Auth::user()->role_id)->get();
        return view('tasks.edit', [
            'task' => $task,
            'users' => $users,
            'userId' => Auth::user()->id,
        ]);
    }
}


