<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\ApiCommunication;
use App\Http\Controllers\Constants\UserRoles;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use ApiCommunication;

    public function __construct()
    {}

    public function login(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials))
            return $this->sendError('Nieprawidłowy email lub hasło',  401);

        $user = $request->user();
        $token = $user->returnNewToken($request->remember_me);

        return $this->sendResponse(['token' => $token->accessToken, 'type' => $user->role_id], 'Successfully logged in!', 200);
    }

    public function logout()
    {
        Auth::user()->token()->revoke();
        return $this->sendResponse(null, 'Successfully logged out!');
    }
}
