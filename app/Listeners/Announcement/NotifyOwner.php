<?php

namespace App\Listeners\Announcement;

use App\Events\Announcement\ActionCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyOwner
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
     * @param  ActionCreated  $event
     * @return void
     */
    public function handle(ActionCreated $event)
    {
        //
    }
}
