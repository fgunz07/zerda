<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodoListAppController extends Controller 
{

	public function index() {

		return view('apps.todolistApp.app');

	}
}
