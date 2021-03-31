<?php

namespace App\Mail;

use App\Models\User\EmailActivationToken;
use App\Models\User\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class EmailVerificationResend extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $urlToVerify;

    /**
     * Create a new message instance.
     *
     * @param User $user
     */
    public function __construct(User  $user)
    {
        $this->user = $user;
        $tokenModel = EmailActivationToken::updateOrCreate([
            'email' => $user->email,
        ], [
            'token' => Str::random(60),
        ]);
        $this->urlToVerify = config('app.front_url') . '/auth/verify?token=' . $tokenModel->token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.EmailVerificationResend')
            ->subject('Potwierdzenie email');
    }
}
