<?php

namespace App\Console\Commands;

use App\Imports\CitiesImport as CitiesImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class Cities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:cities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command importing cities into database';

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

        Excel::import(new CitiesImport, 'cities.csv');
    }
}
