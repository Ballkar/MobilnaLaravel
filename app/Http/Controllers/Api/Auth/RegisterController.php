<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Resources\User as UserResource;
use App\Models\User;

class RegisterController extends BaseController
{

    public function __construct()
    {

    }

    public function register(RegisterRequest $request)
    {

        $user = User::create([
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => 2
        ]);

        return $this->sendResponse(new UserResource($user), 'Account created', 201);
    }
}
