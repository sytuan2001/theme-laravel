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
        $tasks = Task::all();
        return view('todos/home', compact('tasks'));
    }


    public function create(Request $request)
    {
        $title = new Task();
        $title->title = $request->text;
        $title->save();
        return 'Done'();
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:200'
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user();

        Task::create($data);

        return ['status'=>200];

    }
    public function update(Request $request, $id)
    {
        // validate the form
        $request->validate([
            'task' => 'required|max:200'
        ]);

        // update the data
//        DB::table('tasks')->where('id', $id)->update([
//            'task' => $request->task
//        ]);
        Task::where('id', $id)->update(['task' => $request->task]);
//        Task::query()->where()->orWhere()...

        // redirect
        return redirect('/')->with('status', 'Task updated!');
    }
    public function deleteChecked(Request $request)
    {
        $ids = $request->ids;
        Task::whereIn('id',$ids)->delete();
        return reponse()->json(['success'=>"Task delete!"]);
    }

}
