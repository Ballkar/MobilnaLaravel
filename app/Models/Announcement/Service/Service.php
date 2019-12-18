<?php

namespace App\Models\Announcement\Service;

use App\Models\Announcement\Announcement;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = [];
    protected $table = 'announcement_services';

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
    public function service_group()
    {
        return $this->belongsTo(ServiceGroup::class);
    }
}
