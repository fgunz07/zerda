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
		$users = User::with('skills')
						->with('achievements')
						->get();
		$skills = Skill::get()->pluck('id','description');


    	// dd($users);
		return view('pages.dashboard.index')
			->with('users', $users)
			->with('skills', $skills);
	}

	public function viewProfile($id){
        
		$user = User::where('id', $id)->first();
				// dd($users); 	
		
		return view('pages.dashboard.viewProfile')->with('user',$user);
		}
		
	public function filterUser(Request $request, $skill){
		

		
	}


	public function changeRate(Request $request){
		$rate = new Rating();
		$rate->user_id = Auth::user()->id;
		$rate->rating = $request->rating;
		$rate->save();
	}
	
	public function scopeSearchByKeyword(Request $request){
		return response()->json('request',$request);
	}
	
}
