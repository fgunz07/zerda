<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleUserController extends Controller
{
    public function index() {

    	$roles = Role::all();

    	return view('pages.role.index')
    			->with('roles', $roles);

    }

    public function saveRole(Request $request) {

    	try {

    		auth()->user()->assignRole($request->roleName);

    	} catch(Exception $e) {

    		return response()->json(['status' => false , 'message' => $e->getMessage()], 500);

    	}

    	return response()->json(['status' => true , 'message' => 'Role save successfully.']);

    }
}
