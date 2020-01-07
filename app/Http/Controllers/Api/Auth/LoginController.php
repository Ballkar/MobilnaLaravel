<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\ApiCommunication;
use App\Http\Controllers\Constants\Roles;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Resources\User as UserResource;
use Carbon\Carbon;
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
            return $this->sendError('Invalid credentials',  401);

        $user = $request->user();

        if ($request->acc_type == Roles::ROLE_ADMIN && $user->role_id != Roles::ROLE_ADMIN || $request->acc_type != Roles::ROLE_ADMIN && $user->role_id == Roles::ROLE_ADMIN)
            return $this->sendError('Invalid credentials',  401);

        $token = $user->returnNewToken($request->remember_me);

        return $this->sendResponse(['token' => $token->accessToken, 'type' => $user->role_id], 'Successfully logged in!', 200);
    }

    public function logout()
    {
        Auth::user()->token()->revoke();
        return $this->sendResponse(null, 'Successfully logged out!');
    }
}
