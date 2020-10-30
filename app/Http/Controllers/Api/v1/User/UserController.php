<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Api\User\UpdateUserDetailsRequest;
use App\Http\Resources\User\User as UserResource;
use App\Http\Resources\User\UserCollection;
use App\Models\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\BaseResourceCollection;

class UserController extends Controller
{
    use ApiCommunication;

    public function index()
    {
        $users = User::paginate(5);
        return $this->sendResponse(new UserCollection($users), 'All users returned!');
    }

    public function user()
    {
        return $this->sendResponse(new UserResource(Auth::user()), 'User data returned');
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
