<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property int $status
 */
class Task extends Model
{
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
    public function assignee()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
