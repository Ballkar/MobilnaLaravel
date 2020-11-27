<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\import\Cities',
        'App\Console\Commands\import\Locating',
        'App\Console\Commands\init\init',
        'App\Console\Commands\sms\SendMessage',
        'App\Console\Commands\sms\CheckMessage',
        'App\Console\Commands\sms\SendMessagePlans',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('sendMessagePlans')
            ->everyFifteenMinutes();
        $schedule->command('CheckMessage')
            ->dailyAt('13:40');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
