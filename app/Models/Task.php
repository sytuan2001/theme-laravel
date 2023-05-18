<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property int $status
 * @property int $created_by
 * @property string $start_at
 * @property string $end_at
 */
class Task extends Model
{
    const STATUS_TODO = 'todo';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_DONE = 'done';

    protected $fillable = [
        'user_id', 'title', 'description', 'status', 'create_by', 'start_at', 'end_at'
    ];

    /**
     * Get the user that created the task.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'create_by');
    }

    /**
     * Get the user that is assigned to the task.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
