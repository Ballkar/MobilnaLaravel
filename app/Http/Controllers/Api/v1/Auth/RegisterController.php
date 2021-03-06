<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\ApiCommunication;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\User\User as UserResource;
use App\Models\User\User;

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
            'name' => $request->name,
            'role_id' => $request->acc_type,
            'reg' => $request->reg
        ]);

        return $this->sendResponse(null, 'Account created', 204);
    }
}
