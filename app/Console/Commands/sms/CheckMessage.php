<?php

namespace App\Console\Commands\sms;

use App\Services\MessageService;
use Illuminate\Console\Command;

class CheckMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkMessage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check health message service and how much message left';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $messageService = new MessageService();
        $count = $messageService->checkMessageCountAvailable();
        $minimumMessagesCount = env('MESSAGE_CRITICAL_COUNT');

        $this->info('Message count: '.$count);
        if($count < $minimumMessagesCount) {
            $this->info('Messages amount below '.$minimumMessagesCount.' message notification sended');
            $message = 'Doladuj wiadomosci w systemie. Ilosc wiadomosci ponizej '.$minimumMessagesCount;

            $messageService->send($message, env('PHONE_APP_NAME'), env('ADMIN_PHONE'));
        }
        return (int)$count;
    }
}
