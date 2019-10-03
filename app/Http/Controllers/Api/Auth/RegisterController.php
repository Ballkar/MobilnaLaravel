<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Controllers\Controller;
use App\Models\User;

class RegisterController extends Controller
{
    private $auth;

    public function __construct()
    {
//        $this->auth = $auth;
    }

    public function register(RegisterRequest $request)
    {

        $user = User::create([
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => 2
        ]);


        return response()->json([
            'user' => $user
        ], 201);
    }
}
