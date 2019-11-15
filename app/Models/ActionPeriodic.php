<?php

namespace App\Models;

use Carbon\Carbon;

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

    public function scopeBetweenDates($query, $startDate, $endDate)
    {
        $start = Carbon::make($startDate);
        $end = Carbon::make($endDate);

//        return $query->where('week_day', $start->dayOfWeekIso)
//            ->where('start_hour', '<', $start->hour)
//            ->where('start_minute', '>', $start->minute)
//            ->where('end_hour', '<', $end->hour)
//            ->where('end_minute', '>', $end->minute);
        return $query->where('week_day', $start->dayOfWeekIso)
            ->where(function ($query) use ($end) {
                $query->where('start_hour', '<', $end->hour)
                    ->orWhere('start_hour', '=', $end->hour)
                    ->where('start_minute', '<=', $end->minute);
            })->where(function ($query) use ($start) {
                $query->where('end_hour', '>', $start->hour)
                    ->orWhere('end_hour', '=', $start->hour)
                    ->where('end_minute', '>=', $start->minute);
            });
    }
}
