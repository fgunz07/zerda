<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InviteController extends Controller
{
    public function accept(Request $request) 
    {

    	try {

    		DB::table('user_board')
	    		->insert(['user_id' => auth()->user()->id , 'board_id' => $request->board_id]);

	    	auth()->user()->unreadNotifications()->find($request->notf_id)->markAsRead();

    	} catch(Exception $e) {

    		return response()->json(['status' => false, 'message' => $e->getMessage()], 500);

    	}

    	return response()->json(['status' => true, 'message' => 'Invitation accepted.'], 200);

    }

    public function reject(Request $request) 
    {

    	auth()->user()->unreadNotifications()->find($request->notf_id);

    	return response()->json(['status' => true , 'message' => 'Invitation rejected.']);

    }
}
