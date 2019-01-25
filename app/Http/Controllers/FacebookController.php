<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;

class FacebookController extends Controller
{
    public function getFacebookInfo() {

        return Socialite::driver('facebook')->redirect();

    }
}
