<?php

namespace App\Mail;

use App\Models\User\ResetPasswordToken;
use App\Models\User\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class PasswordResend extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $urlToResend;

    /**
     * Create a new message instance.
     *
     * @param User $user
     */
    public function __construct(User  $user)
    {
        $this->user = $user;

        $tokenModel = ResetPasswordToken::updateOrCreate([
            'email' => $user->email,
        ], [
            'token' => Str::random(60),
        ]);

        $token = $tokenModel->token;
        $this->urlToResend = config('app.front_url') . '/auth/password-reset/' . $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.PasswordResend')
            ->subject('Reset hasła');
    }
}
