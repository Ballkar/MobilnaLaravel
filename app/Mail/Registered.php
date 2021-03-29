<?php

namespace App\Mail;

use App\Models\User\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Registered extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $urlToFrontend;
    public $urlToVerify;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User  $user)
    {
//        $tokenModel = EmailActivationToken::updateOrCreate([
//            'email' => $notifiable->email,
//        ], [
//            'token' => Str::random(60),
//        ]);
        $this->urlToFrontend = config('app.front_url');
        $this->urlToVerify = $this->urlToFrontend . '/auth/verify/';
//        . $tokenModel->token
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
