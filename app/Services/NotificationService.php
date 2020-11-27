<?php


namespace App\Services;


use App\Models\User\Notification;

class NotificationService
{
    public static $NOTIFICATION_TYPE_INFO = 'INFO';
    public static $NOTIFICATION_TYPE_WARNING = 'WARNING';
    public static $NOTIFICATION_TYPE_ERROR = 'ERROR';

    public function __construct()
    {

    }

    public function sendNotification($user_id, $title, $message, $type = null)
    {
        $type = isset($type) ? $type : NotificationService::$NOTIFICATION_TYPE_INFO;
        Notification::create([
            'user_id' => $user_id,
            'type' => $type,
            'title' => $title,
            'message' => $message,
        ]);
    }

    public function sendNotificationToAdmin($title, $message, $type = null)
    {
        $type = isset($type) ? $type : NotificationService::$NOTIFICATION_TYPE_INFO;
        Notification::create([
            'user_id' => 1,
            'type' => $type,
            'title' => $title,
            'message' => $message,
        ]);
    }
}
