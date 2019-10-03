<?php

namespace App\Models;

use App\Models\Blog\Post;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

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


    public function setPasswordAttribute($password)
    {
        return $this->attributes['password'] = Hash::make($password);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function data()
    {
        return $this->hasOne(UserData::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }


    public function isAdmin()
    {
        return $this->role_id === 1;
    }
}
