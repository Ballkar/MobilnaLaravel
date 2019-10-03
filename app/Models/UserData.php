<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserData extends Authenticatable
{
    use Notifiable;

    protected $guarded = [
        'name', 'email', 'password', 'role_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
