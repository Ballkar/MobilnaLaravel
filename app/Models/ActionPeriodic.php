<?php

namespace App\Models;

class ActionPeriodic extends BaseAction
{
    protected $table = 'calendar_action_periodic';
    protected $guarded = [];

    /**
     * Get the announcement that owns the action.
     */
    public function announcement()
    {
        return $this->belongsTo(Announcement::class);
    }

    /**
     * Get the announcement that owns the action.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
