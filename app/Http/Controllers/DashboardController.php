<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Skill;

class DashboardController extends Controller
{
    public function index(){
		$users = User::all();
		$skills = Skill::all();
    	// dd($users);
		return view('pages.dashboard.index')
		->with('users', $users)
		->with('skills', $skills);
    }
}
