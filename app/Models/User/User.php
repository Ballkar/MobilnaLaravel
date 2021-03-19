<?php

namespace App\Models\User;

use App\Events\User\UserWasRegistered;
use App\Http\Controllers\Constants\Roles;
use App\Models\Announcement\Customer;
use App\Models\Message\Plans\RemindPlan;
use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $guarded = [];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'tutorials' => 'array',
    ];

    public static function boot()
    {
        static::created(function (User $user) {
            event(new UserWasRegistered($user));
            Wallet::create([
                'owner_id' => $user->id,
                'money' => 0,
            ]);
            RemindPlan::create([
                'owner_id' => $user->id,
                'body' => RemindPlan::$defaultBody,
                'hour' => 17,
                'minute' => 0,
                'time_type' => RemindPlan::$time_type_day_before,
            ]);

            $notificationService = new NotificationService();
            $notificationService->sendNotificationToAdmin('Nowy user!', 'Zarejestrował się user o emailu'. $user->email, NotificationService::$NOTIFICATION_TYPE_INFO);
        });

        parent::boot();
    }

    public function setPasswordAttribute($password)
    {
        return $this->attributes['password'] = Hash::make($password);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'owner_id');
    }

    public function isAdmin()
    {
        return $this->role_id === Roles::ROLE_ADMIN;
    }

    public function isUser()
    {
        return $this->role_id === Roles::ROLE_USER;
    }

    public function remindPlan()
    {
        return $this->hasOne(RemindPlan::class, 'owner_id');
    }

    public function returnNewToken($remember = false)
    {
        $tokenRes = $this->createToken('Personal Access Token');
        $token = $tokenRes->token;

        if ($remember) $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return $tokenRes;
    }
}
