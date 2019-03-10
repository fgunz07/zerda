<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class SearchController extends Controller
{
    public function results(Request $request) 
    {

    	$users = User::with('roles')
    					->whereHas('roles', function ($query) {
    						if(auth()->user()->hasRole(['Senior Develop', 'Developer'])) {
    							$query->whereIn('name', ['Client']);
    						} else {
    							$query->whereIn('name', ['Senior Developer', 'Developer']);
    						}
    					})
    					->orWhere('first_name', 'LIKE', '%'.$request->search.'%')
    					->orWhereHas('skills', function ($query) use ($request) {
    						$query->where('name', 'LIKE', '%'.$request->search.'%');
    					})
    					->with('skills')
    					->with('boards')
    					->get();

    	$users->sortBy(function($items) {
				return $items->boards->count();
			});

    	return view('pages.search.index')
    			->with('users', $users);
    }
}
