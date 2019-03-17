<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Services\RatingService;

class InviteController extends Controller
{
    public function accept(Request $request) 
    {

    	try {

    		DB::table('user_board')
	    		->insert(['user_id' => auth()->user()->id , 'board_id' => $request->board_id]);

	    	auth()->user()->unreadNotifications()->find($request->notf_id)->markAsRead();

            (new RatingService)->projectRate();

            (new RatingService)->totalAvg();

    	} catch(Exception $e) {

    		return response()->json(['status' => false, 'message' => $e->getMessage()], 500);

    	}

    	return response()->json(['status' => true, 'message' => 'Invitation accepted.'], 200);

    }

    public function reject(Request $request) 
    {

    	auth()->user()->unreadNotifications()->find($request->notf_id)->markAsRead();

        $user = User::findOrFail(auth()->user()->id);
        $user->rl = $user->rl + 1;
        $user->save();

        (new RatingService)->projectRate();

        (new RatingService)->totalAvg();

    	return response()->json(['status' => true , 'message' => 'Invitation rejected.']);

    }
}
