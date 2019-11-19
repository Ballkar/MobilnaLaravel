<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    public $start;
    public $end;
    public $single_actions;
    public $periodic_actions;

    public function __construct($start_date, $end_date, $user_id)
    {
        $this->start = $start_date;
        $this->end = $end_date;

        $user = User::where('id', $user_id)->first();

        $this->single_actions = $user->actions_single()->betweenDates($this->start, $this->end)->get();
        $this->periodic_actions = $user->actions_periodic()->betweenDates($this->start, $this->end)->get();
    }

    public function getActions()
    {
        dd($this->single_actions);
        return $this->periodic_actions->merge($this->single_actions);
    }

}
