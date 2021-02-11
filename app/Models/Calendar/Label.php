<?php

namespace App\Models\Calendar;

use Illuminate\Database\Eloquent\Model;
use App\Models\User\User;

class Label extends Model
{
    protected $guarded = [];
    protected $table = 'calendar_labels';

    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }
}
