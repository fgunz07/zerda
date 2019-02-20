<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
	public function __construct(User $user)
	{
			$this->user = $user;
	}
		
    public function index(){
			// $users = User::all();
			$rateUser ='';
			$users = User::with('skills')
							->with('achievements')
							->with('rateDev')
							->get();
							
			$skillsList = Skill::all();

			$rateUser = $this->user->getRate($rateUser);


		
		// dd($rateUser);
	
		return view('pages.dashboard.index')
			->with('users', $users)
			->with('rateUser',$rateUser)
			->with('skillsList', $skillsList);
	}

	public function viewProfile($id){
        
		$user = User::where('id', $id)
					  ->with('skills')
						->with('achievements')
						->first();
		// dd($data); 	
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

	
		// dd($rateUser);
		// $rate = User::updateOrCreate(
		// 	['id' => $rateUser[0]->id],
		// 	['rating_id' => $rateUser[0]->ratings_average]);
	}
	
	public function scopeSearchByKeyword(Request $request){
		return response()->json('request',$request);
	}
	
	
}
