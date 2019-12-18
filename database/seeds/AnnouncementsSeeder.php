<?php

use App\Models\Announcement\Announcement;
use App\Models\Announcement\Service\Service;
use App\Models\Announcement\Service\ServiceGroup;
use App\Models\Announcement\Service\ServiceType;
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
            'owner_id' => '2',
        ]);

        Announcement::create([
            'name' => 'testowe ogłoszenie nr.2',
            'description' => 'testowy opis ogłoszenia',
            'city_id' => '823',
            'owner_id' => '2',
        ]);

        ServiceGroup::create([
            'name' => 'Paznokcie'
        ]);
        ServiceGroup::create([
            'name' => 'Make-up'
        ]);
        ServiceGroup::create([
            'name' => 'Rzęsy'
        ]);

        Service::create([
            'announcement_id' => 1,
            'group_id' => 1,
            'name' => 'Hybryda',
            'price' => 12,
            'time_hours' => 1,
            'time_minutes' => 30,
        ]);
        Service::create([
            'announcement_id' => 1,
            'group_id' => 1,
            'name' => 'Przedłużanie na żelu',
            'price' => 12,
            'time_hours' => 1,
            'time_minutes' => 30,
        ]);
    }
}
