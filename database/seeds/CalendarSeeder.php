<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CalendarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('announcement_action_types')->insert(
            [
                'name' => 'REQUEST',
            ]
        );
        DB::table('announcement_action_types')->insert(
            [
                'name' => 'APPOINTMENT',
            ]
        );
    }
}
