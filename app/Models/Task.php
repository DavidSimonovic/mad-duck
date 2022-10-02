<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class Task extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable =
        [
            'task_title',
            'task_description',
            'user_id',
            'status',
            'deadline',
            'todo_list_id',
        ];
}
