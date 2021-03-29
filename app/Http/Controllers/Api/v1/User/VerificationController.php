<?php
namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\ApiCommunication;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\User as UserResource;
use App\Mail\EmailVerificationResend;
use App\Models\User\EmailActivationToken;
use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

/**
 * @group  Users
 */
class VerificationController extends Controller
{
    use VerifiesEmails;
    use ApiCommunication;

    public function verify(Request $request)
    {
        $activation = EmailActivationToken::where('token', $request->get('token'))
            ->first();

        if (!$activation) {
            throw new AuthorizationException();
        }
        if (Carbon::parse($activation->updated_at)->addMinutes(config('auth.tokens_expiration_time.register'))->isPast()) {
            $activation->delete();

            throw new AuthorizationException();
        }

        $user = User::where('email', $activation->email)->first();

        if (!$user) {
            throw new AuthorizationException();
        }

        $user->email_verified_at = now();
        $user->save();

        $activation->delete();

        return $this->sendResponse(null, 'Account verified', 204);
    }

    public function resend(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();
        if (! $user->hasVerifiedEmail()) {
            Mail::to($user->email)
                ->send(new EmailVerificationResend($user));
        }

        return $this->sendResponse(null, 'Email sent', 204);
    }
}
