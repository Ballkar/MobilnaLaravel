<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\ApiCommunication;
use App\Http\Controllers\Constants\Roles;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Resources\User as UserResource;
use App\Models\User;

class RegisterController extends Controller
{
    use ApiCommunication;

    public function __construct()
    {

    }

    public function register(RegisterRequest $request)
    {

        $user = User::create([
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => Roles::ROLE_USER,
            'reg' => $request->reg
        ]);

        return $this->sendResponse(new UserResource($user), 'Account created', 201);
    }
}
