<?php

namespace App\Console\Commands;

use App\Http\Controllers\MessageController;
use CitiesTableSeeder;
use DatabaseSeeder;
use Illuminate\Console\Command;

class SendMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendMessage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Init sending message';

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
        $from = 'Mobilna';
        $to = $this->ask('Type phone number?');
        $message = $this->ask('Type message?');

        $controller = new MessageController();
        $controller->send($message, $from, $to);
    }
}
