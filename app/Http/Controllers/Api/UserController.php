<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiCommunication;
use App\Http\Resources\User as UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use ApiCommunication;

    public function user()
    {
        return $this->sendResponse(new UserResource(Auth::user()), 'User data');
    }
}
