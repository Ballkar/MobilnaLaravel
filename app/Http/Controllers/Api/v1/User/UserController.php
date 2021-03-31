<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\ApiCommunication;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreNewPasswordRequest;
use App\Http\Requests\UserRequest;
use App\Mail\PasswordResend;
use App\Models\User\ResetPasswordToken;
use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User\User as UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Hashing\Hasher;

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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function markTutorialDone(Request $request)
    {
        $request->validate([
            'tutorial' => ['required', 'string'],
        ]);
        $user = $request->user('api');
        $tutorialToAdd = $request->get('tutorial');

        $tutorialsDone = collect($user->tutorials);
        if(!$tutorialsDone->contains($tutorialToAdd)) {
            $tutorialsDone->add($tutorialToAdd);
            $user->update(['tutorials' => $tutorialsDone->toArray()]);
            return $this->sendResponse(new UserResource($user), 'Tutorial updated');
        }

        return $this->sendResponse(new UserResource($user), 'Nothing changed');
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

    public function sendResetPasswordMail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();

        if ($user) {
            Mail::to($user->email)
                ->send(new PasswordResend($user));
        }

        return $this->sendResponse(null, 'Password reset email sent', 204);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
            'token' => 'required'
        ]);
        $resetTokenModel = ResetPasswordToken::where('token', $request->token)->first();

        if (!$resetTokenModel) {
            throw new AuthorizationException();
        }

        if (Carbon::parse($resetTokenModel->updated_at)->addMinutes(config('auth.passwords.users.expire'))->isPast()) {
            $resetTokenModel->delete();

            throw new AuthorizationException();
        }

        $user = User::where('email', $resetTokenModel->email)->first();

        if (!$user) {
            throw new AuthorizationException();
        }

        $user->password = $request->password;
        $user->save();
        $resetTokenModel->delete();

        return $this->sendResponse(null, 'Password changed', 204);
    }
}
