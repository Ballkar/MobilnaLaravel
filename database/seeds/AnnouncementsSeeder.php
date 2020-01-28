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
            'description' => 'Jestem młodą i zajebistą kosmetyczkąChętnie ogarnę ci paznokietki tak że 
będziesz mega zadowolona. Pracuje w ten 
sposób już ponad 3 lata i przez ten czas nie
miałam sytuacji w której dziewczyny 
były nie zadowolone. Odezwij się a na pewno razem znajdziemy
pomysł na twoje paznokcie, ponieważ także
chętnie doradzam swoim klientom.
',
            'city_id' => '821',
            'owner_id' => '2',
            'is_mobile' => '1',
            'mobile_price' => '10',
            'mobile_distance' => '100',
        ]);

        Announcement::create([
            'description' => 'Jestem młodą i zajebistą kosmetyczkąChętnie ogarnę ci paznokietki tak że 
będziesz mega zadowolona. Pracuje w ten 
sposób już ponad 3 lata i przez ten czas nie
miałam sytuacji w której dziewczyny 
były nie zadowolone. Odezwij się a na pewno razem znajdziemy
pomysł na twoje paznokcie, ponieważ także
chętnie doradzam swoim klientom.
',
            'city_id' => '821',
            'owner_id' => '2',
            'is_local' => '1',
            'road' => 'szmaciarksa',
            'house_number' => '12',
        ]);

        Announcement::create([
            'name' => 'testowe ogłoszenie nr.2',
            'description' => 'Jestem młodą i zajebistą kosmetyczkąChętnie ogarnę ci paznokietki tak że 
będziesz mega zadowolona. Pracuje w ten 
sposób już ponad 3 lata i przez ten czas nie
miałam sytuacji w której dziewczyny 
były nie zadowolone. Odezwij się a na pewno razem znajdziemy
pomysł na twoje paznokcie, ponieważ także
chętnie doradzam swoim klientom.
',
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
        Service::create([
            'announcement_id' => 2,
            'group_id' => 1,
            'name' => 'Przedłużanie na żelu',
            'price' => 12,
            'time_hours' => 1,
            'time_minutes' => 30,
        ]);
        Service::create([
            'announcement_id' => 2,
            'group_id' => 1,
            'name' => 'Przedłużanie na żelu',
            'price' => 20,
            'time_hours' => 1,
            'time_minutes' => 30,
        ]);
        Service::create([
            'announcement_id' => 2,
            'group_id' => 1,
            'name' => 'Tipsy',
            'price' => 12,
            'time_hours' => 1,
            'time_minutes' => 30,
        ]);
        Service::create([
            'announcement_id' => 2,
            'group_id' => 1,
            'name' => 'Wzorki',
            'price' => 5,
            'time_hours' => 1,
            'time_minutes' => 30,
        ]);
        Service::create([
            'announcement_id' => 2,
            'group_id' => 1,
            'name' => 'Usuwanie pazokci',
            'price' => 5,
            'time_hours' => 1,
            'time_minutes' => 30,
        ]);
    }
}
