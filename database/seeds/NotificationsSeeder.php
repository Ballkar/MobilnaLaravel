<?php

use App\Models\User\Notification;
use App\Services\NotificationService;
use Illuminate\Database\Seeder;

class NotificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Notification::create([
            'user_id' => 1,
            'type' => NotificationService::$NOTIFICATION_TYPE_INFO,
            'title' => 'Witaj!',
            'message' => 'Aplikacja została zainicjalizowana poprawnie.',
        ]);
    }
}
