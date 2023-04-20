<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('todos.home', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create', [
            'task' => new Task()
        ]);
    }

    public function store(Request $request)
    {
        $task = new Task();
        $task->user_id = auth()->user()->id;
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->status = 0;
        $task->save();

        $tasks = Task::where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->get();
        return view('todos.home', compact('tasks'))->with('success', 'Task created successfully');
        return redirect()->back()->withErrors([
            'error' => 'Please enter both title and description'
        ]);
        
    }

    public function update(Request $request, $id)
    {
        $task = Task::findorFail($id);
        if (!$task) {
            return response()->json(['error' => 'Task not found']);
        }
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->status = $request->input('status');
        $task->save();

        $task = Task::find($id);
        return response()->json(['success' => 'Task updated successfully']);
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['error' => 'Task not found']);
        }
        $task->delete();


        return response()->json(['success' => 'Task deleted successfully']);
    }

    public function deleteChecked(Request $request)
    {
        $ids = $request->ids;
        Task::whereIn('id', $ids)->delete();

        return response()->json(['success' => "Task delete!"]);
    }

    public function updateStatus(Request $request)
    {
        $taskIds = $request->input('task_id');
        if (!empty($taskIds)) {
            foreach ($taskIds as $taskId) {
                $task = Task::find($taskId);
                if ($task) {
                    $task->status = 1;
                    $task->save();
                }
            }
        }

        return response()->json(['success' => 'Status updated successfully.']);
    }
}
