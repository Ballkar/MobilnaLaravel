<?php

namespace App\Models\Announcement\Service;

use Illuminate\Database\Eloquent\Model;

class ServiceGroup extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'announcement_service_groups';

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
