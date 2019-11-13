<?php

namespace App\Models;

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
     * Get the action single for the announcement.
     */
    public function action()
    {
        return $this->hasMany(ActionSingle::class);
    }

}
