<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Skill;
use App\Education;
use App\Location;
use App\Specialization;

class DashboardController extends Controller
{
    public function index(){
		// $users = User::all();
		$users = User::with('child_user_location')
				->with('child_user_specilization')
				->with('child_user_achievement')
				->get();
		$skills = Skill::all();
    	// dd($users);
		return view('pages.dashboard.index')
			->with('users', $users)
			->with('skills', $skills);
	}
	
	public function changeRate(){
        
    }
}
