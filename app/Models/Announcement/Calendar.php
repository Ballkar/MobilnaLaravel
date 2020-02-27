<?php

namespace App\Models\Announcement;

use App\Models\User\User;
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
        $calendar = collect([]);

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
                    'start_date' => Carbon::create($date->year, $date->month, $date->day, $action['start_hour'], $action['start_minute'])->toDateTimeString(),
                    'end_date' => Carbon::create($date->year, $date->month, $date->day, $action['end_hour'], $action['end_minute'])->toDateTimeString(),
                    'start_timestamp' => Carbon::create($date->year, $date->month, $date->day, $action['start_hour'], $action['start_minute'])->timestamp,
                    'end_timestamp' => Carbon::create($date->year, $date->month, $date->day, $action['end_hour'], $action['end_minute'])->timestamp,
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
                    'start_date' => $action['start_date']->toDateTimeString(),
                    'end_date' => $action['end_date']->toDateTimeString(),
                    'start_timestamp' => $action['start_date']->timestamp,
                    'end_timestamp' => $action['end_date']->timestamp,
                    'start_hour' => $action['start_date']->hour,
                    'start_minute' => $action['start_date']->minute,
                    'end_hour' => $action['end_date']->hour,
                    'end_minute' => $action['end_date']->minute,
                    'type_id' => $action['type_id'],
                ]);
            }

            $actions = $actions->sort(function($prev, $next) {
                return $prev['start_timestamp'] < $next['start_timestamp'] ? -1 : 1;
            })->values();

            $conflictCount = 0;
            foreach ($actions as $number=>&$action) {
                $action['conflict_with'] = collect([]);
                $action['conflict'] = false;

                for($next = $number + 1; $next < $actions->count(); $next++) {
                    $conflict = $action['end_timestamp'] > $actions[$next]['start_timestamp'];
                    if($conflict) $action['conflict_with']->push(['id' => $actions[$next]['id'], 'periodic' => $actions[$next]['periodic']]);
                    if($conflict) $conflictCount++;
                    if(!$conflict) break;
                }

                for($prev = $number - 1; $prev >= 0; $prev--) {
                    $conflict = $action['start_timestamp'] < $actions[$prev]['end_timestamp'];
                    if($conflict) $action['conflict_with']->push(['id' => $actions[$prev]['id'], 'periodic' => $actions[$prev]['periodic']]);
                    if(!$conflict) break;
                }

                $action['conflict'] = !$action['conflict_with']->isEmpty();
                $actions[$number] = $action;
            }

            $day = [
                'week_day' => $date->dayOfWeekIso,
                'date' => $date->toDateString(),
                'actions' => $actions->values(),
                'conflicts' => $conflictCount,
            ];
            $calendar[$dayCount] = $day;
        }

        return ['days' => $calendar, 'conflicts' => $calendar->sum('conflicts')];
    }

}
