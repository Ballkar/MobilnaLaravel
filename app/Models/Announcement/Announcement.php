<?php

namespace App\Models\Announcement;

use App\Models\Announcement\Calendar\ActionPeriodic;
use App\Models\Announcement\Calendar\ActionSingle;
use App\Models\Announcement\Service\Service;
use App\Models\City;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Announcement extends Model
{
    protected $guarded = [];

    public function getImageAttribute()
    {
        $imageMain = $this->images->where('main', 1)->first();
        $url = $imageMain ? $imageMain->path : Storage::disk('public')->url('default.jpg');
        return $url;
    }

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
        return $this->hasMany(Image::class);
    }

    /**
     * Get the services for the announcement.
     */
    public function services()
    {
        return $this->hasMany(Service::class);
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

    public function scopeActive($query)
    {
        return $query->where('is_active', '1');
    }

}
