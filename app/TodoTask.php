<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TodoTask extends Model
{
    protected $table    = 'todo_task';

    protected $fillable = [
        'todo_id',
        'task_id'
    ];
}
