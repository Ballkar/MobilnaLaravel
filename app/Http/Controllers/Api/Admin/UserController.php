<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Api\User\StoreUserRequest;
use App\Http\Requests\Api\User\UpdateUserRequest;
use App\Models\User\User;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    use ApiCommunication;

    /**
     * @return JsonResponse
     */
    public function index()
    {
        $users = User::paginate(10);
        return $this->sendResponse($users, 'All users returned!', 200);
    }

    /**
     * @param StoreUserRequest $request
     * @return JsonResponse
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => $request->role_id,
            'reg' => false,
        ]);

        return $this->sendResponse($user, 'User created', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user)
    {
        return $this->sendResponse($user, 'User returned', 201);
    }

    /**
     * @param UpdateUserRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated()); // TODO: dodać dane usera do możliwości update dla admina

        return $this->sendResponse($user, 'Update Success!', 200);

    }

    /**
     * @param User $user
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(User $user)
    {
        // TODO: soft delete albo zwykły
        $user->delete();
        return $this->sendResponse(null, 'User deleted', 200);
    }
}
