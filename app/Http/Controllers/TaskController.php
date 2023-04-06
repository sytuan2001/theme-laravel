<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())->get();
        return view('tasks.index', compact('tasks'));
    }


    public function create()
    {
        return view('tasks.create');
    }
    public function store(Request $request)
    {
        $task = new Task();
        $task->user_id = auth()->user()->id;
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->status = 0;
        $task->save();
        return response()->json(['success'=>'Task created successfully']);
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['error'=>'Task not found']);
        }
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->status = $request->input('status');
        $task->save();
        return response()->json(['success'=>'Task updated successfully']);
    }
    public function destroy($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['error'=>'Task not found']);
        }
        $task->delete();
        return response()->json(['success'=>'Task deleted successfully']);
    }
    public function deleteChecked(Request $request)
    {
        $ids = $request->ids;
        Task::whereIn('id',$ids)->delete();
        return reponse()->json(['success'=>"Task delete!"]);
    }

}
