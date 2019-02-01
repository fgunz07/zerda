<?php

namespace App\Services;

use App\SocialFacebookAccount;
use App\User;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialFacebookAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {

        // first look for user when authenticating using facebook
        $account = SocialFacebookAccount::whereProvider('facebook')
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            // if account exist
            return $account->user;

        } else {

            // create user facebook
            $account = new SocialFacebookAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);

            // find user using email from provider
            $user = User::whereEmail($providerUser->getEmail())->first();

            // if no user found
            if (!$user) {

                // create new user on users table
                $user = User::create([
                    'email'         => $providerUser->getEmail(),
                    'first_name'    => $providerUser->user['first_name'],
                    'middle_name'   => array_key_exist('middle_name', $providerUser->user) ? $providerUser->user['middle_name'] : null,
                    'last_name'     => $providerUser->user['last_name'],
                    'name'          => $providerUser->getName(),
                    'password'      => md5(rand(1,10000)),
                ]);
            }

            // associate relationship
            $account->user()->associate($user);
            $account->save();

            // return user
            return $user;
        }
    }
}