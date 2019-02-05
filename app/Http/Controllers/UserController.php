<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function availableUsers(Request $request) {

        $users = User::role('Sinior Developer','Developer')
                    ->where('status', 0)
                    ->get();

        return response()->json($users);

    }
}
