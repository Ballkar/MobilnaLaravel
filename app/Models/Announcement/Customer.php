<?php

namespace App\Models\Announcement;

use App\Models\Calendar\Work;
use App\Models\Message\Message;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    /**
     * Get the user that owns the action.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Get the user that owns the action.
     */
    public function works()
    {
        return $this->hasMany(Work::class);
    }

    /**
     * Get the user that owns the action.
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

}
