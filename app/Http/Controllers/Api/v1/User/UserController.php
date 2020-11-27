<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\ApiCommunication;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User as UserResource;

class UserController extends Controller
{
    use ApiCommunication;

    public function user()
    {
        return $this->sendResponse(new UserResource(Auth::user()), 'User returned');
    }

//    /**
//     * @param CustomerRequest $request
//     * @param Customer $customer
//     * @return JsonResponse
//     */
//    public function update(CustomerRequest $request, Customer $user)
//    {
//        $user->update($request->validated());
//        return $this->sendResponse(new UserResource($user), 'User updated');
//    }
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
