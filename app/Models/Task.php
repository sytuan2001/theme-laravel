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
        'user_id', 'title', 'description', 'status','create_by','start_at','end_at'
    ];
}
