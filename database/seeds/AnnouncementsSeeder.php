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
            'name' => 'Kosmetyka'
        ]);
        ServiceGroup::create([
            'name' => 'Rzęsy'
        ]);

        ServiceType::create([
            'group_id' => 1,
            'name' => 'Hybryda'
        ]);
        ServiceType::create([
            'group_id' => 1,
            'name' => 'Żelowe'
        ]);

        Service::create([
            'announcement_id' => 1,
            'type_id' => 1,
            'additional_name' => 'dodatkowy tytuł',
            'price' => 12,
            'time_hours' => 1,
            'time_minutes' => 30,
        ]);
        Service::create([
            'announcement_id' => 1,
            'type_id' => 1,
            'price' => 12,
            'time_hours' => 1,
            'time_minutes' => 30,
        ]);
    }
}
