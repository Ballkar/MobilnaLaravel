<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $guarded = [];

    public function getMainImageAttribute($value)
    {
        return env('APP_URL').'/storage/announcements/'.$this->id.'/'.Image::where('id', $value)->first()['imageName'];
    }

    /**
     * Get the user that owns the announcement.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
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

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

}
