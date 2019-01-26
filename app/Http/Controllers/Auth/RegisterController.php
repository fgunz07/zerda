<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        $rules = [
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
            'email'      => 'required|email|string|unique:users',
            'password'   => 'required|string|confirmed',
            'country_id' => 'required|integer',
        ];

        $messages = [
            'first_name.required'   => 'Firstname is required.',
            'last_name.required'    => 'Lastname is required.',
            'email.required'        => 'Email is required',
            'email.unique'          => 'Email already in used.',
            'email.email'           => 'Email Invalid format.',
            'password.required'     => 'Password is required.',
            'password.confirmed'    => 'Password does not match.',
            'country_id.required'   => 'Please select a country.',
            'country_id.integer'    => 'Country format is invalid.',
        ];

        return Validator::make($data, $rules, $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        return User::create([
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'middle_name'   => $data['middle_name'],
            'email'         => $data['email'],
            'country_id'    => $data['country_id'],
            'password'      => Hash::make($data['password']),
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // $this->validator($request->all())->validate();

        $validate = $this->validator($request->toArray());

        if($validate->fails()) {

            return response()->json(['status' => false , 'errors' => $validate->errors()], 422);

        }

        event(new Registered($user = $this->create($request->all())));

        return response()->json(['status' => true, 'message' => 'User created.']);

        // $this->guard()->login($user);

        // return $this->registered($request, $user)
        //                 ?: redirect($this->redirectPath());
    }

}
