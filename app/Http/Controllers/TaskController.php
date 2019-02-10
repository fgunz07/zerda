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

    public function assign(Request $request) {

    	try {

    		$task = Task::findOrFail($request->task_id);
    		$task->developer = $request->dev;
    		$task->save();

    	} catch (Exception $e) {

    		return response()->json(['status' => false , 'message' => $e->getMessage()], 500);

    	}

    	return response()->json(['status' => true , 'message' => 'Success']);

    }

    public function endDate(Request $request) {

    	Task::findOrFail($request->task_id)
    			->update(['developer' => $request->dev]);

    	return response()->json(['status' => true , 'message' => 'Success']);

    }
}
