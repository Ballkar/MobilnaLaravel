<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class init extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialization command';

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
        $this->call('migrate:fresh');
        $this->info('Migration complete');

        $this->call('db:seed');
        $this->info('Seed complete');

        $this->info('Init All DONE');
    }
}
