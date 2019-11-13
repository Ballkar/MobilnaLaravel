<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceGroup extends Model
{


    public function services()
    {
        return $this->hasMany(AnnouncementService::class);
    }
}
