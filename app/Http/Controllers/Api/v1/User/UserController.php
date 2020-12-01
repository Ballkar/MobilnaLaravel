<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\ApiCommunication;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreNewPasswordRequest;
use App\Http\Requests\UserRequest;
use App\Models\User\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User\User as UserResource;
use Illuminate\Support\Facades\Hash;

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

    public function passwordChange(StoreNewPasswordRequest $request)
    {
        $user = Auth::user();
        $oldPassword = $request->get('password');
        $newPassword = $request->get('new_password');
        if (!Hash::check($oldPassword, $user->password)) {
            return $this->sendError('Nieprawidłowy email lub hasło',  422, [
                'password' => ['Niepoprawne hasło']
            ]);
        }

        $user->password = $newPassword;
        $user->save();
        return $this->sendResponse(new UserResource($user), 'Password changed ' . $newPassword);
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
