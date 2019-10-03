<?php

namespace App\Http\Controllers\Auth;

use App\Events\TestEvent;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\UserData;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

            'name' => ['string', 'max:255', 'min:3'],
            'phone' => ['string', 'size:9'],
            'address' => ['string', 'min:2', 'max:1000'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'email' => $data['email'],
            'password' => $data['password'],
            'role_id' => '2',
        ]);

        UserData::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'user_id' => $user->id,
        ]);

        return $user;
    }
}
