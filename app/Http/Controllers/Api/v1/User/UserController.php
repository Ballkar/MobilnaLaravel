<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\ApiCommunication;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User\User as UserResource;

class UserController extends Controller
{
    use ApiCommunication;

    public function user()
    {
        return $this->sendResponse(new UserResource(Auth::user()), 'User returned');
    }

    /**
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function update(UserRequest $request)
    {
        $user = Auth::user();
        $user->update($request->validated());
        return $this->sendResponse(new UserResource($user), 'Profile updated');
    }
//
//    /**
//     * @param Customer $customer
//     * @return JsonResponse
//     * @throws Exception
//     */
//    public function destroy(Customer $user)
//    {
//        $user->delete();
//        return $this->sendResponse(null, 'User deleted', 204);
//    }
}
