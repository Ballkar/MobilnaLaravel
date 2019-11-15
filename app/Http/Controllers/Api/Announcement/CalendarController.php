<?php

namespace App\Http\Controllers\Api\Announcement;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Api\Announcement\GetCalendarRequest;
use App\Models\Announcement;
use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    use ApiCommunication;



    public function show(GetCalendarRequest $request, Announcement $announcement)
    {

        $user = User::where('id', Auth::id())->first();
//        die(dump($request->get('end_date')));

        $singleActions = $user->actions_single()->betweenDates($request->get('start_date'), $request->get('end_date'))->get();
        $periodicActions = $user->actions_periodic()->betweenDates($request->get('start_date'), $request->get('end_date'))->get();
        $calendar = new Calendar();
        return $this->sendResponse($calendar, 'calendar returned');
    }

}
