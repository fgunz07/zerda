<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Services\SocialFacebookAccountService;

class FacebookController extends Controller
{

	/**
   * Create a redirect method to facebook api.
   *
   * @return void
   */
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

     /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function callback(SocialFacebookAccountService $service)
    {

    	$fields = Socialite::driver('facebook')
    						->fields([
			                    'name', 
			                    'first_name', 
			                    'last_name',
			                    'middle_name',
			                    'email',
			                    'gender', 
			                    'verified'
			                ])
                            ->stateless();

        $user = $service->createOrGetUser($fields->user());

        auth()->login($user);

        return redirect()->to('/dashboard');
    }
}
