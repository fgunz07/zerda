<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'tasks',
        'class_name'
    ];

    public function todos() {

    	// return $this->belongsTo('App\Todo', 'todo_task');

    }
}
