<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Skill;

class TodoListAppController extends Controller 
{

	public function index() {

		$skills = Skill::all();

		return view('apps.todolistApp.pages.index')
				->with('skills', $skills);

	}
}
