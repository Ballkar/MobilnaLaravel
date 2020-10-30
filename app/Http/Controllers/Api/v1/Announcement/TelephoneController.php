<?php

namespace App\Http\Controllers\Api\v1\Announcement;

use App\Http\Controllers\ApiCommunication;
use App\Models\Announcement\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TelephoneController extends Controller
{
    use ApiCommunication;

    public function show(Announcement $announcement)
    {
        $announcement->update(['number_taken' => $announcement->number_taken+1]);
        return $this->sendResponse($announcement->owner->phone, 'Phone returned!');
    }
}
