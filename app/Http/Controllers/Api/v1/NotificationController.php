<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiCommunication;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\Notification as NotificationResource;
use App\Http\Resources\User\NotificationCollection;
use App\Models\User\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    use ApiCommunication;

    public function calculate(Request $request)
    {
        $notifications = Notification::where('user_id', Auth::id())->where('is_read', 0)->get();
        return $this->sendResponse($notifications->count(), 'Unreaded notiication calculated!');
    }

    public function index(Request $request)
    {
        $limit = $request->get('limit') ? $request->get('limit') : 10;
        $notifications = Notification::where('user_id', Auth::id())->paginate($limit);
        foreach ($notifications as $notification) {
            $notification1 = clone $notification;
            $notification1->setAsRead();
        }
        return $this->sendResponse(new NotificationCollection($notifications), 'Notification returned');
    }

    public function show(Notification $notification)
    {
        $notification->setAsRead();
        return $this->sendResponse(new NotificationResource($notification), 'Notification returned');
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();
        return $this->sendResponse(null, 'Notification deleted', 204);
    }
}
