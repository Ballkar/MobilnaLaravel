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
//        $this->daysDifference = $end->diffInDays($start)

        $user = User::where('id', $user_id)->first();

        $this->single_actions = $user->actions_single()->betweenDates($this->start, $this->end)->get();
        $this->periodic_actions = $user->actions_periodic()->betweenDates($this->start, $this->end)->get();
    }

    public function getActions()
    {
        return collect([$this->single_actions, $this->periodic_actions]);
    }

}
