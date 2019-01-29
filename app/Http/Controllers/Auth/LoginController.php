<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validateLogin(Request $request)
    {
        // $request->validate([
        //     $this->username() => 'required|string',
        //     'password' => 'required|string',
        // ]);

        $data = $request->toArray();

        $rules = [
            'email'     => 'required|string|email',
            'password'  => 'required|string' 
        ];

        $messages = [
            'email.required' => 'Email is required.',
            'email.email'    => 'Invalid email format.',
            'password.required'=> 'Password is required.',
        ];

        $validate = Validator::make($data, $rules, $messages);

        if($validate->fails()) {

            return response()->json(['status' => false , 'errors' => $validate->errors()], 422);

        }
    }
}
