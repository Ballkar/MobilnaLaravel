<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Announcement extends Model
{
    protected $guarded = [];
    protected $appends = ['image', 'city_name'];
    protected $with = ['services'];
    protected $hidden = ['images', 'city'];

    public function getImageAttribute()
    {
        $imageMain = $this->images->where('main', 1)->first();
        $url = $imageMain ? $imageMain->path : Storage::disk('public')->url('default.jpg');
        return $url;
    }

    public function getCityNameAttribute()
    {
        return $this->city->name;
    }
//
//    public function getServicesAttribute()
//    {
//        return $this->services;
//    }
    /**
     * Get the user that owns the announcement.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Get the city that owns the announcement.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    /**
     * Get the services for the announcement.
     */
    public function images()
    {
        return $this->hasMany(AnnouncementImage::class);
    }

    /**
     * Get the services for the announcement.
     */
    public function services()
    {
        return $this->hasMany(AnnouncementService::class);
    }

    /**
     * Get the action single for the announcement.
     */
    public function actions_single()
    {
        return $this->hasMany(ActionSingle::class);
    }

    /**
     * Get the action periodic for the announcement.
     */
    public function actions_periodic()
    {
        return $this->hasMany(ActionPeriodic::class);
    }

}
