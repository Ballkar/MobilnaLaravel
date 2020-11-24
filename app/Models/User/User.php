<?php

namespace App\Models\User;

use App\Events\User\UserWasRegistered;
use App\Http\Controllers\Constants\Roles;
use App\Models\Announcement\Customer;
use App\Models\Message\Plan;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        static::created(function ($model) {
            event(new UserWasRegistered($model));
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

    public function returnNewToken($remember = false)
    {
        $tokenRes = $this->createToken('Personal Access Token');
        $token = $tokenRes->token;

        if ($remember) $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return $tokenRes;
    }
}
