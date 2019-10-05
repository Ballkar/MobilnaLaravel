<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Resources\User as UserResource;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{

    public function __construct()
    {}

    public function login(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials))
            return $this->sendError('Invalid credentials',  401);

        $user = $request->user();
        $token = $user->returnNewToken($request->remember_me);

        return $this->sendResponse([
            'user' => new UserResource($user),
            'token' => $token->accessToken,
            'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString()
        ], 'Successfully logged in!');

    }

    public function logout()
    {
        Auth::user()->token()->revoke();
        return $this->sendResponse(null, 'Successfully logged out!');
    }

    public function user()
    {
        return $this->sendResponse(new UserResource(Auth::user()), 'User data');
    }
}
