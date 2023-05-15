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
        $user = User::query();
        if (Auth::user()->role == "admin") {
            $user->whereIn('role', ['leader', 'member']);
        } elseif (Auth::user()->role == "leader") {
            $user->whereIn('role', ['member']);
        } else {
            $user->where('id', Auth::user()->id);
        }
        $users = $user->get();

        $user_task = User::query();
        if (Auth::user()->role == "admin") {
            $user_task->whereIn('role', ['admin', 'leader', 'member']);
        } elseif (Auth::user()->role == "leader") {
            $user_task->whereIn('role', ['leader', 'member']);
        } else {
            $user_task->where('id', Auth::user()->id);
        }
        $user_task = $user_task->get()->pluck('id');
//        dd($user_task);
        $tasks = $this->taskService->getTasks($user_task);

        return view('todos.home', ['tasks' => $tasks, 'users' => $users]);
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


