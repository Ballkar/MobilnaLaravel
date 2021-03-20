<?php

namespace App\Providers;

use App\Models\Announcement\Customer;
use App\Models\Calendar\Work;
use App\Models\Message\Message;
use App\Models\Message\Plans\RemindPlanSchema;
use App\Models\User\Wallet;
use App\Models\User\WalletTransaction;
use App\Models\Calendar\Label;
use App\Policies\Admin\RemindPlanSchemaPolicy;
use App\Policies\Admin\WalletPolicy;
use App\Policies\Admin\WalletTransactionPolicy;
use App\Policies\Calendar\WorkPolicy;
use App\Policies\CustomerPolicy;
use App\Policies\Message\MessagePolicy;
use App\Policies\Calendar\LabelPolicy;
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
        RemindPlanSchema::class => RemindPlanSchemaPolicy::class,
        Message::class => MessagePolicy::class,
        Customer::class => CustomerPolicy::class,
        Work::class => WorkPolicy::class,
        Label::class => LabelPolicy::class,
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
