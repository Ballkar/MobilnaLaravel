<?php

use App\Models\Announcement\Calendar\ActionPeriodic;
use App\Models\Announcement\Calendar\ActionSingle;
use Illuminate\Database\Seeder;

class ActionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ActionPeriodic::create([
            'type_id' => 1,
            'announcement_id' => 1,
            'owner_id' => 2,
            'week_day' => 2,
            'start_hour' => '12',
            'start_minute' => '30',
            'end_hour' => '14',
            'end_minute' => '00',
        ]);

        ActionSingle::create([
            'type_id' => 2,
            'announcement_id' => 1,
            'customer_id' => 1,
            'owner_id' => 2,

            'start_date' => '2019-01-06 12:00:00',
            'end_date' => '2019-01-06 13:00:00',
        ]);
        ActionSingle::create([
            'type_id' => 2,
            'announcement_id' => 1,
            'customer_id' => 1,
            'owner_id' => 2,

            'start_date' => '2019-01-05 11:00:00',
            'end_date' => '2019-01-05 13:00:00',
        ]);
    }
}
