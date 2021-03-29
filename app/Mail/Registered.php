<?php

namespace App\Mail;

use App\Models\User\ResetPasswordToken;
use App\Models\User\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class Registered extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $urlToVerify;

    /**
     * Create a new message instance.
     *
     * @return void
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
        $this->urlToVerify = config('app.front_url') . '/auth/verify?token=' . $token;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.registered')
            ->subject('Witamy w Mobilna Kosmetyczka');
    }
}
