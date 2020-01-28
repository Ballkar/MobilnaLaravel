<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Api\User\UpdateUserDetailsRequest;
use App\Http\Resources\User as UserResource;
use App\Models\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use ApiCommunication;

    public function user()
    {
//        return $this->sendResponse(Auth::user(), 'User data');
        return $this->sendResponse(new UserResource(Auth::user()), 'User data returned');
    }

    public function index()
    {
        $users = User::all();
        return $this->sendResponse(new UserResource($users), 'All users returned!');
    }

    public function show(User $user)
    {
        return $this->sendResponse(new UserResource($user), 'User data returned');
    }

    public function getPhone(User $user)
    {

        return $this->sendResponse($user->phone, "User's phone number returned");
    }

    public function update(UpdateUserDetailsRequest $request, User $user)
    {
        $user->update($request->validated());
        return $this->sendResponse(new UserResource($user), 'User updated!');
    }

    public function destroy(User $user)
    {
        //
    }
}
