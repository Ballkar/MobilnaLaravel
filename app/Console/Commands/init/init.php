<?php

namespace App\Console\Commands\init;

use CitiesTableSeeder;
use DatabaseSeeder;
use Illuminate\Console\Command;

class init extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init {--cities}';

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
        $this->call('telescope:install');
        $this->info('Migration start');
        $this->call('migrate:fresh');
        $this->info('Migration complete');

        if($this->option('cities')) {
            $this->call('import:cities');
            $this->info('Importing cities complete');
            $this->call('location:cities');
            $this->info('Locating cities complete');
        } else {
            $seeder = new DatabaseSeeder();
            $seeder->call(CitiesTableSeeder::class);
        }

        $this->info('Seeding start');
        $this->call('db:seed');
        $this->info('Seed complete');

        $this->call('passport:install');
        $this->info('Passport auth activated');

        $this->info('Init All DONE');
    }
}
