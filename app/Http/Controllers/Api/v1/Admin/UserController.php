<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Api\User\StoreUserRequest;
use App\Http\Requests\Api\User\UpdateUserRequest;
use App\Http\Resources\User\UserCollection;
use App\Models\User\User;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\User as UserResources;
use App\Http\Resources\BaseResourceCollection;

class UserController extends Controller
{
    use ApiCommunication;

    /**
     * @return JsonResponse
     */
    public function index()
    {
        $users = User::paginate(10);
        return $this->sendResponse(new UserCollection($users), 'All users returned!', 200);
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

        return $this->sendResponse(new UserResources($user), 'User created', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user)
    {
        return $this->sendResponse(new UserResources($user), 'User returned');
    }

    /**
     * @param UpdateUserRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated()); // TODO: dodać dane usera do możliwości update dla admina

        return $this->sendResponse(new UserResources($user), 'Update Success!', 200);

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
        return $this->sendResponse(null, 'User deleted', 204);
    }
}
