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
		$skillsList = Skill::all();


		// dd($users);
		// dd($skillsList);
		return view('pages.dashboard.index')
			->with('users', $users)
			->with('skillsList', $skillsList);
	}

	public function viewProfile($id){
        
		$user = User::where('id', $id)
					  ->with('skills')
						->with('achievements')
						->first();
				// dd($user); 	
		$ratedesc = Ratingdesc::all();
		// dd($ratedesc);
		return view('pages.dashboard.viewProfile')
						->with('user',$user)
						->with('ratedesc',$ratedesc);
		}


	public function changeRate(Request $request, $id){
		$rate = new Rating();
		$rate->user_id = $id;
		$rate->rating = $request->rating;
		$rate->save();
	}
	
	public function scopeSearchByKeyword(Request $request){
		return response()->json('request',$request);
	}
	
}
