<?php

namespace App\Mail;

use App\Models\User\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

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
        $this->urlToVerify = config('app.front_url') . '/auth/verify/';
        $this->user = $user;
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
