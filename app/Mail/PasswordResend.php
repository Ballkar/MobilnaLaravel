<?php

namespace App\Mail;

use App\Models\User\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

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
        $token = 'abc';
        $this->urlToResend = config('app.front_url') . '/auth/password-reset/' . $token;
        $this->user = $user;
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
