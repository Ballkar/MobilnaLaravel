<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnnouncementService extends Model
{
    protected $guarded = [];

    /**
     * Get the announcement that owns the service.
     */
    public function announcement()
    {
        return $this->belongsTo(Announcement::class);
    }

    /**
     * Get the service group associated with service.
     */
    public function service_type()
    {
        return $this->belongsTo(AnnouncementServiceType::class);
    }
}
