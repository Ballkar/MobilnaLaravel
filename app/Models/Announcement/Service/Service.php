<?php

namespace App\Models\Announcement\Service;

use App\Models\Announcement\Action;
use App\Models\Announcement\Announcement;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = [];
    protected $table = 'announcement_services';

    public function actions()
    {
        return $this->belongsToMany(Action::class);
    }

    public function announcement()
    {
        return $this->belongsTo(Announcement::class);
    }

    public function service_group()
    {
        return $this->belongsTo(ServiceGroup::class);
    }
}
