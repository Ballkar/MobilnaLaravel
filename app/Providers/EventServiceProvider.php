<?php

namespace App\Providers;

use App\Events\Announcement\ActionCreated;
use App\Events\Announcement\ActionWasApproved;
use App\Events\User\UserWasRegistered;
use App\Listeners\Announcement\NotifyCustomer;
use App\Listeners\Announcement\NotifyOwner;
use App\Listeners\User\SendEmailAfterRegistration;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserWasRegistered::class => [
            SendEmailAfterRegistration::class,
        ],
        ActionCreated::class => [
            NotifyOwner::class,
        ],
        ActionWasApproved::class => [
            NotifyCustomer::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
