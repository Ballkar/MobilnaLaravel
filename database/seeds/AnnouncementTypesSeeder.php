<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnnouncementTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('announcement_types')->insert(
            [
                'name' => 'PRIVATE_MOBILE'
            ]
        );
        DB::table('announcement_types')->insert(
            [
                'name' => 'PRIVATE_LOCAL'
            ]
        );
        DB::table('announcement_types')->insert(
            [
                'name' => 'PRIVATE_BOTH'
            ]
        );
        DB::table('announcement_types')->insert(
            [
                'name' => 'STUDIO'
            ]
        );
    }
}
