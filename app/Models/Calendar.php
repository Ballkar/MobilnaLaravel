<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    public $start;
    public $end;
    public $single_actions;
    public $periodic_actions;
    public $daysDifference;

    public function __construct(string $start_date, string $end_date, $user_id)
    {
        $this->start = Carbon::make($start_date);
        $this->end = Carbon::make($end_date);
        $this->daysDifference = $this->start->diffInDays($this->end);

        $user = User::where('id', $user_id)->first();

        $this->single_actions = $user->actions_single()->betweenDates($this->start, $this->end)->get();
        $this->periodic_actions = $user->actions_periodic()->betweenDates($this->start, $this->end)->get();
    }

    public function getActions()
    {
        $calendar = [];

        for ($dayCount = 0; $dayCount <= $this->daysDifference; $dayCount++) {
            $calendar[$dayCount] = [];
            $actions = collect([]);
            $date = clone($this->start);
            $date->addDays($dayCount);

            $singleActions = $this->single_actions->filter(function ($value) use ($date) {
                return $value['start_date']->toDateString() === $date->toDateString();
            });
            $periodicActions = $this->periodic_actions->filter(function ($value) use ($date) {
                return $value['week_day'] == $date->dayOfWeekIso;
            });

            foreach ($periodicActions as $action) {
                $actions->push([
                    'id' => $action['id'],
                    'periodic' => true,
                    'start_hour' => $action['start_hour'],
                    'start_minute' => $action['start_minute'],
                    'end_hour' => $action['end_hour'],
                    'end_minute' => $action['end_minute'],
                    'type_id' => $action['type_id'],
                ]);
            }
            foreach ($singleActions as $action) {
                $actions->push([
                    'id' => $action['id'],
                    'periodic' => false,
                    'start_hour' => $action['start_date']->hour,
                    'start_minute' => $action['start_date']->minute,
                    'end_hour' => $action['end_date']->hour,
                    'end_minute' => $action['end_date']->minute,
                    'type_id' => $action['type_id'],
                ]);
            }

            $actions = $actions->sort(function($prev, $next) {
                if($prev['start_hour'] === $next['start_hour']) {
                    if($prev['start_minute'] === $next['start_minute']) return 0;
                    return $prev['start_minute'] < $next['start_minute'] ? -1 : 1;
                }
                return $prev['start_hour'] < $next['start_hour'] ? -1 : 1;
            });

            $day = [
                'week_day' => $date->dayOfWeekIso,
                'date' => $date->toDateString(),
                'actions' => $actions
            ];
            $calendar[$dayCount] = $day;
        }

        return $calendar;
    }

}
