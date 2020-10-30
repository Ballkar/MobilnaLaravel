<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\SendPasswordLinkRequest;
use App\Http\Requests\Api\Auth\StoreNewPasswordRequest;
//use App\Jobs\Users\GenerateUserTokenForPasswordLink;
use App\Models\User\User;
use Illuminate\Contracts\Hashing\Hasher;
//use Tymon\JWTAuth\JWTAuth as Auth;
//use Tymon\JWTAuth\Facades\JWTAuth;
//use Webpatser\Uuid\Uuid;

class PasswordController extends Controller
{

    public function __construct()
    {
    }

    public function storeEmail(SendPasswordLinkRequest $request)
    {
        $uuid = Uuid::generate();

        $this->dispatch(new GenerateUserTokenForPasswordLink(
            $request->email,
            $uuid->string
        ));

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Password activation link has been sent'
        ]);
    }

    public function checkToken($token)
    {

        if (User::where('remember_token', $token)->exists()) {

            $user = User::where('remember_token', $token)->firstOrFail();

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Invitation exists',
                'data' => [
                    'item' => $user,
                    'token' => $token
                ]
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'status' => 'error',
                'message' => 'Not found'
            ], 404);
        }
    }

    public function storePassword(StoreNewPasswordRequest $request)
    {
        $uuid = $uuid = Uuid::generate();

        $user = User::where('remember_token', $request->token)->firstOrFail();
        $user->password = $this->hasher->make($request->password);
        $user->save();

        $user = User::where('remember_token', $request->token)->firstOrFail();
        $user->remember_token = $uuid->string;
        $user->save();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Password changed',
            'data' => [
                'item' => $user
            ]
        ]);
    }
}
