<?php

namespace App\Listeners\Announcement;

use App\Events\Announcement\ActionWasApproved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyCustomer
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ActionWasApproved  $event
     * @return void
     */
    public function handle(ActionWasApproved $event)
    {

    }
}
