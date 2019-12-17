<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnnouncementServiceType extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    /**
     * Get the service group associated with service.
     */
    public function service_group()
    {
        return $this->belongsTo(AnnouncementServiceGroup::class);
    }
}
