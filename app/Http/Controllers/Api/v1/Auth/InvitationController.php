<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\StoreInvitationPasswordRequest;
use App\Models\User\User;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Contracts\Mail\Mailer;
use Webpatser\Uuid\Uuid;

class InvitationController extends Controller
{
    private $hasher;
    private $mailer;
    private $config;

    public function __construct(Hasher $hasher, Mailer $mailer, Repository $config)
    {
        $this->hasher = $hasher;
        $this->mailer = $mailer;
        $this->config = $config;

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

    public function storePassword(StoreInvitationPasswordRequest $request)
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
            'message' => 'Password has been set',
            'data' => [
                'item' => $user
            ]
        ], 200);
    }
}
