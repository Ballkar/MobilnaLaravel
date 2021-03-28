<?php

namespace App\Console\Commands\init;

use CitiesTableSeeder;
use DatabaseSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class email extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'email command';

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
        Mail::raw('działa', function($message) {
            $message->to('arkadiusz.latka@o2.pl')
            ->subject('test');
        });
    }
}
