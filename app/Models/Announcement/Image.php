<?php

namespace App\Models\Announcement;

use App\Models\BaseImage;
use Illuminate\Support\Facades\Storage;

class Image extends BaseImage
{
    protected $guarded = [];
    protected $appends = ['path'];
    protected $table = 'announcement_images';

    public function getPathAttribute()
    {
        return Storage::disk('public')->url('announcements/' . $this->announcement_id . '/' . $this->name);
    }

    /**
     * Get the Announcement that owns the image.
     */
    public function announcement()
    {
        return $this->belongsTo(Announcement::class);
    }
}
