<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;

class FacebookController extends Controller
{

    public function getAuthFacebook() {

    	// return facebook driver to redirect user to facebook login/confirmation
        return Socialite::driver('facebook')->redirect();

    }

    public function fbOauth() {

    	dd(Socialite::driver('facebook')->user());


    }
}
