<?php

namespace App\Listeners\User;

use App\Events\User\UserWasRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailAfterRegistration
{
    /**
     * SendEmailAfterRegistration constructor.
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  UserWasRegistered  $event
     * @return void
     */
    public function handle(UserWasRegistered $event)
    {
        die(dump($event->user->id));
    }
}
