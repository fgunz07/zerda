<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Task;

class TaskController extends Controller
{
    public function listTask() {

    }

    public function store(Request $request) {

    	$task = Task::create($request->all());

    	DB::table('todo_task')
    		->insert(['task_id' => $task->id, 'todo_id' => $request->todo_id]);

    	return response()->json(['message' => 'Task saved.']);

    }
}
