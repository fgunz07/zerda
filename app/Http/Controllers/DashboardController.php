<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Skill;
use App\Education;
use App\Location;
use App\Specialization;
use App\Rating;
use App\Ratingdesc;
use App\Events\InviteDeveloper;

class DashboardController extends Controller
{
    public function index(){
		// $users = User::all();
		$users = User::with('child_user_location')
				->with('child_user_specilization')
				->with('child_user_achievement')
				->with('child_user_rating')
				->get();
		$skills = Skill::all();
    	// dd($users);
		return view('pages.dashboard.index')
			->with('users', $users)
			->with('skills', $skills);
	}

	public function viewProfile($id){
        
		$users = User::where('id', $id)
				->with('child_user_education')
				->with('child_user_location')
				->with('child_user_specilization')
				->with('child_user_achievement')
				->get();
		// dd($users);	
		// return response()->json(['users'=>$user]);
		return view('pages.dashboard.viewProfile')->with('users',$users);
    }

	public function changeRate(Request $request){
		$rate = new Rating();
		$rate->user_id = Auth::user()->id;
		$rate->rating = $request->rating;
		$rate->save();
    }
}
