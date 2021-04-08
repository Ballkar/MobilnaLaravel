<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User\User;

class Worker extends Model
{
    protected $guarded = [];
    protected $table = 'workers';

    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }
}
