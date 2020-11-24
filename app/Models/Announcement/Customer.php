<?php

namespace App\Models\Announcement;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];

    /**
     * Get the user that owns the action.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user that owns the action.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

}
