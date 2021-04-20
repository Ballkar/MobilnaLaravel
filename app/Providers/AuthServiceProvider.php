<?php

namespace App\Providers;

use App\Models\Announcement\Customer;
use App\Models\Calendar\Work;
use App\Models\Message\Message;
use App\Models\Message\Plans\PlanSchema;
use App\Models\User\User;
use App\Models\User\Wallet;
use App\Models\User\WalletTransaction;
use App\Models\Worker;
use App\Policies\Admin\UserPolicy;
use App\Policies\Message\PlanSchemaPolicy;
use App\Policies\Admin\WalletPolicy;
use App\Policies\Admin\WalletTransactionPolicy;
use App\Policies\Calendar\WorkPolicy;
use App\Policies\CustomerPolicy;
use App\Policies\Message\MessagePolicy;
use App\Policies\Calendar\WorkerPolicy;
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
        User::class => UserPolicy::class,
        PlanSchema::class => PlanSchemaPolicy::class,
        Message::class => MessagePolicy::class,
        Customer::class => CustomerPolicy::class,
        Work::class => WorkPolicy::class,
        Worker::class => WorkerPolicy::class,
        Wallet::class => WalletPolicy::class,
        WalletTransaction::class => WalletTransactionPolicy::class,
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
