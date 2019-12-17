<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnnouncementServiceGroup extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function services()
    {
        return $this->hasMany(AnnouncementService::class);
    }
}
