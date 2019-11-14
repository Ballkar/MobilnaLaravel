<?php

namespace App\Http\Controllers\Api\Announcement;

use App\Http\Controllers\ApiCommunication;
use App\Models\Announcement;
use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Models\User;

class CalendarController extends Controller
{
    use ApiCommunication;



    public function show(Announcement $announcement)
    {
//        $test = User::where('id', 2)->first()->actions_periodic;
//        die(dump($test));
        $calendar = new Calendar();
        return $this->sendResponse($calendar, 'calendar returned');
    }

}
