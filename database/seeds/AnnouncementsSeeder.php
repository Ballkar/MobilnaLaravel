<?php

use App\Models\Announcement;
use App\Models\AnnouncementService;
use App\Models\AnnouncementServiceGroup;
use App\Models\AnnouncementServiceType;
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

        AnnouncementServiceGroup::create([
            'name' => 'Paznokcie'
        ]);
        AnnouncementServiceGroup::create([
            'name' => 'Kosmetyka'
        ]);
        AnnouncementServiceGroup::create([
            'name' => 'Rzęsy'
        ]);

        AnnouncementServiceType::create([
            'group_id' => 1,
            'name' => 'Hybryda'
        ]);
        AnnouncementServiceType::create([
            'group_id' => 1,
            'name' => 'Żelowe'
        ]);

        AnnouncementService::create([
            'announcement_id' => 1,
            'type_id' => 1,
            'additional_name' => 'dodatkowy tytuł',
            'price' => 12,
            'time_hours' => 1,
            'time_minutes' => 30,
        ]);
        AnnouncementService::create([
            'announcement_id' => 1,
            'type_id' => 1,
            'price' => 12,
            'time_hours' => 1,
            'time_minutes' => 30,
        ]);
    }
}
