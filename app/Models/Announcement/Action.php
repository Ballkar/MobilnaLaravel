<?php

namespace App\Models\Announcement;

use App\Models\Announcement\Announcement;
use App\Models\BaseAction;
use App\Models\Announcement\Customer;
use App\Models\User\User;

class Action extends BaseAction
{
    protected $table = 'announcement_actions';
    protected $guarded = [];
    protected $dates = ['start_date', 'end_date'];
    protected $casts = [
        'services' => 'array'
    ];

    /**
     * Get the announcement that owns the action.
     */
    public function announcement()
    {
        return $this->belongsTo(Announcement::class);
    }

    /**
     * Get the user that owns the action.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the customer that owns the action.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function scopeBetweenDates($query, $startDate, $endDate)
    {
        return $query->where('start_date', '<', $endDate)->where('end_date', '>', $startDate);
    }
}
