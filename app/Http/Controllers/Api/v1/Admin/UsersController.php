<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\ApiCommunication;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddUsersRequest;
use App\Http\Requests\Admin\UsersListRequest;
use App\Http\Resources\User\UsersCollection;
use App\Http\Resources\User\User as UserResource;
use App\Models\User\User;

class UsersController extends Controller
{
    use ApiCommunication;

    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    public function index(UsersListRequest $request)
    {
        $users = User::paginate($request->limit);

        return $this->sendResponse(new UsersCollection($users), 'Users returned');
    }

    public function store(AddUsersRequest $request)
    {
        User::create([
            'email' => $request->email,
            'password' => $request->password,
            'name' => $request->name,
            'role_id' => $request->acc_type,
            'reg' => $request->reg,
        ]);

        return $this->sendResponse(null, 'Account created', 204);
    }

    public function show(User $user)
    {
        return $this->sendResponse(new UserResource($user), 'User returned');
    }

}
