<?php

namespace App\Http\Controllers\Api\v1\Announcement;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Api\Announcement\GetCalendarRequest;
use App\Models\Announcement\Announcement;
use App\Http\Controllers\Controller;
use App\Models\Announcement\Calendar;
use App\Http\Resources\BaseResourceCollection;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    use ApiCommunication;



    public function show(GetCalendarRequest $request, Announcement $announcement)
    {
        $calendar = new Calendar($request->get('start_date'), $request->get('end_date'), Auth::id());
        return $this->sendResponse($calendar->getActions(), 'Calendar returned');
    }

}
