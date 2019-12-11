<?php

use App\Models\Announcement;
use Illuminate\Database\Seeder;

class AnnouncementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Announcement::create([
            'name' => 'testowe ogłoszenie',
            'description' => 'testowy opis ogłoszenia',
            'city_id' => '821',
            'type_id' => '2',
            'owner_id' => '2',
        ]);

        Announcement::create([
            'name' => 'testowe ogłoszenie nr.2',
            'description' => 'testowy opis ogłoszenia',
            'city_id' => '823',
            'type_id' => '3',
            'owner_id' => '2',
        ]);
    }
}
