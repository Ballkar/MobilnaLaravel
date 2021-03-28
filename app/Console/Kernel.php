<?php

namespace App\Console;

use App\Models\Message\Plans\RemindPlan;
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
        'App\Console\Commands\init\email',
        'App\Console\Commands\sms\SendMessage',
        'App\Console\Commands\sms\CheckMessage',
        'App\Console\Commands\sms\SendMessageRemindPlans',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('SendMessageRemindPlans')
            ->dailyAt(RemindPlan::$sendHour.':'.RemindPlan::$sendMinute);
        $schedule->command('CheckMessage')
            ->dailyAt('18');
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
