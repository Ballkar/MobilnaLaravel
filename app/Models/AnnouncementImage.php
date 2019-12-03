<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AnnouncementImage extends Image
{
    protected $guarded = [];
    protected $appends = ['path'];

    public function getPathAttribute()
    {
        return Storage::disk('public')->url('announcements/' . $this->id . '/' . $this->name);
    }

    /**
     * Get the Announcement that owns the image.
     */
    public function announcement()
    {
        return $this->belongsTo(Announcement::class);
    }
}
