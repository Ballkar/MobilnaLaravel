<?php

namespace App\Http\Controllers\Constants;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WeekDays extends Controller
{
    const MONDAY = 1;
    const TUESDAY = 2;
    const WEDNESDAY = 3;
    const THURSDAY = 4;
    const FRIDAY = 5;
    const SATURDAY = 6;
    const SUNDAY = 7;


    static public function returnAll() {
        return [static::MONDAY, static::TUESDAY, static::WEDNESDAY, static::THURSDAY, static::FRIDAY, static::SATURDAY, static::SUNDAY ];
    }
}
