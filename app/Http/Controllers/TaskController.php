<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Models\Task;
use App\Models\User;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(private TaskService $taskService)
    {
    }
    public function index(TaskService $taskService)
    {
        $tasks = $taskService->getTasks(auth()->id());
        return view('todos.home', compact('tasks'));
    }


    public function create()
    {
        $users = User::where('role_id', '<', auth()->user()->role_id)->get();
        return view('tasks.create', [
            'task' => new Task(),
            'users' => $users,
            'userId' => auth()->user()->id
        ]);
    }


    public function store(CreateTaskRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->user()->name;
        $task = $this->taskService->createTask($data, auth()->user()->id);

        return redirect('/tasks');
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

    public function edit(Task $task)
    {
        $users = User::where('role', '<', auth()->user()->role)->orderBy('role', 'desc')->get();
        return view('tasks.edit', compact('task', 'users'));
    }
}

