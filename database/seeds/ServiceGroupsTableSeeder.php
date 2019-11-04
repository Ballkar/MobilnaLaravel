<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ServiceGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_groups')->insert(
            [
                'name' => 'Paznokcie'
            ]
        );
        DB::table('service_groups')->insert(
            [
                'name' => 'Kosmetyka'
            ]
        );
        DB::table('service_groups')->insert(
            [
                'name' => 'Rzęsy'
            ]
        );
    }
}
