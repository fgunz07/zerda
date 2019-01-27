<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

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

    	Todo::create($request->all());

    	return response()->json(['message' => 'Record save.']);

    }
}
