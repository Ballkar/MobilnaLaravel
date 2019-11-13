<?php

namespace App\Http\Controllers\Api\Announcement;

use App\Http\Controllers\ApiCommunication;
use App\Models\Announcement;
use App\Http\Controllers\Controller;
use App\Models\Calendar;

class CalendarController extends Controller
{
    use ApiCommunication;



    public function show(Announcement $announcement)
    {
        $calendar = new Calendar();
        return $this->sendResponse($calendar, 'calendar returned');
    }

}
