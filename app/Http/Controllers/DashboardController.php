<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class DashboardController extends Controller
{
    public function index(){
    	$users = User::all();
    	// dd($users);
    	return view('pages.dashboard.index')->with('users', $users);
    }
}
