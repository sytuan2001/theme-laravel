<?php

namespace App\Services;

use App\Models\Task;
use App\Models\User;
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
        $user = Auth::user();
        $role = $user->role;

        $query = $this->task->orderBy('created_at', 'desc');

        if ($role == 'admin') {
            return $this->task->orderBy('created_at', 'desc')->get();
        }

        if ($role == 'leader') {
            $userIds = User::where('role', 'member')->pluck('id')->toArray();
            $userIds[] = $userId;

            return $query->with(['creator', 'user'])
                ->whereIn('user_id', $userIds)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return $query->where('user_id', $userId)->get();
    }

    public function createTask(array $data, int $userId)
    {
        $data['user_id'] = $userId;
        $data['status'] = Task::STATUS_TODO;
        $data['created_by'] = auth()->user()->id;
        $data['start_at'] = now();
        $data['end_at'] = now();

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
        return $this->task->whereIn('id', $ids)->update(['status' => Task::STATUS_DONE]);
    }
}

