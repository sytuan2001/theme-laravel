<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function getTasks($userId)
    {
        return $this->task->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function createTask(array $data, int $userId)
    {
        $user = User::find($userId);
        $data['user_id'] = $userId;
        $data['status'] = 'todo';
        $data['created_by'] = $user->name;

        $task = new Task($data);
        $task->save();

        return $task;
    }


    public function updateTask($id, array $data)
    {
        $task = $this->task->findOrFail($id);
        $task->fill($data)->save();
        return $task;
    }

    public function deleteTask($id)
    {
        $task = $this->task->findOrFail($id);
        return $task->delete();
    }

    public function deleteTasks(array $ids)
    {
        return $this->task->whereIn('id', $ids)->delete();
    }

    public function updateTaskStatus(array $ids)
    {
        return $this->task->whereIn('id', $ids)->update(['status' => 1]);
    }
}

