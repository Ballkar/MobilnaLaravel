<?php

namespace App\Providers;

use App\Models\Announcement\Customer;
use App\Models\Calendar\Work;
use App\Models\Message\Message;
use App\Models\Message\Plan;
use App\Models\Message\Schema;
use App\Policies\Calendar\WorkPolicy;
use App\Policies\CustomerPolicy;
use App\Policies\Message\MessagePolicy;
use App\Policies\Message\PlanPolicy;
use App\Policies\Message\SchemaPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Message::class => MessagePolicy::class,
        Plan::class => PlanPolicy::class,
        Schema::class => SchemaPolicy::class,
        Customer::class => CustomerPolicy::class,
        Work::class => WorkPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::personalAccessTokensExpireIn(now()->addHour());
    }
}
