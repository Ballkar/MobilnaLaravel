<?php

namespace App\Models\Announcement;

use App\Models\Announcement\Announcement;
use App\Models\BaseAction;
use App\Models\User\User;
use Carbon\Carbon;

class WorkTime extends BaseAction
{
    protected $table = 'announcement_work_time';
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

    public function scopeBetweenDates($query, Carbon $start, Carbon $end)
    {
        $diff = $end->diffInDays($start);
        $days = [];
        $day = $start->dayOfWeekIso;
        for ($i = 0; $i <= $diff; $i++) {
            if (!in_array($day, $days)) array_push($days, $day);
            $day++;
            if ($day === 8) $day = 1;
        }

        return $query->whereIn('week_day', $days)
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
