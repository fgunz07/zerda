<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use App\TodoTask;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    public function index() {

    	return view('pages.todo');

    }

    // query all todo
    public function listTodo() {

    	// $todos = Todo::orderBy('created_at')->get();
        $todos = Todo::all();

    	return response()->json($todos);

    }

    // store data database 
    public function store(Request $request) {

        
        DB::transaction(function () use ($request) {

            $todo = Todo::create($request->all());

            DB::table('board_todo')
                ->insert(['board_id' => $request->board_id, 'todo_id' => $todo->id]);

        });
        

    	return response()->json(['message' => 'Record save.']);

    }

    // delete data database
    public function delete($id) {

        Todo::findOrFail($id)->delete();

        return response()->json(['status' => true , 'message' => 'Deleted successfully.']);

    }

    // update relation ship
    public function UpdateTodoTask(Request $request) {

        $getTask = TodoTask::where('todo_id' , $request->old)
                        ->where('task_id' , $request->task_id)
                        ->first();

        $getTask->todo_id = $request->todo_id;
        $getTask->task_id = $request->task_id;
        $getTask->save();

        return response()->json(['message' => 'Item move to another position']);

    }
}
