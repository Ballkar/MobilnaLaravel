<?php

namespace App\Models\Announcement\Service;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $table = 'announcement_service_types';

    /**
     * Get the service group associated with service.
     */
    public function service_group()
    {
        return $this->belongsTo(ServiceGroup::class);
    }
}
