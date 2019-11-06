<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CalendarActionTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('calendar_action_types')->insert(
            [
                'name' => 'FREE_TIME',
            ]
        );
        DB::table('calendar_action_types')->insert(
            [
                'name' => 'CLIENT',
            ]
        );
    }
}
