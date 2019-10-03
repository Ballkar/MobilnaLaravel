<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Models\User;
use Carbon\Carbon;
use http\Env\Request;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    private $hasher;
    private $auth;

    public function __construct()
    {
//        $this->hasher = $hasher;
//        $this->auth = $auth;
    }

    public function login(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

//        dd($request->user());
//        $user = User::find(1);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);

    }

    private function checkIfUserExists($email, $password)
    {
//        $user = User::where('email', $email)->first();
//
//        return $user ? $this->hasher->check($password, $user->password) : false;
    }

    public function logout()
    {
//        JWTAuth::invalidate(JWTAuth::getToken());
//
//        return response()->json([
//            'code' => 200,
//            'status' => 'success',
//            'message' => 'User logged out'
//        ], 200);

    }

    public function user()
    {
        return response()->json([
            'message' => Auth::user()
        ], 201);
    }
}
