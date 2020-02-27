<?php

use App\Models\Announcement\WorkTime;
use App\Models\Announcement\Action;
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
        WorkTime::create([
            'announcement_id' => 1,
            'owner_id' => 2,
            'week_day' => 2,
            'start_hour' => '12',
            'start_minute' => '30',
            'end_hour' => '14',
            'end_minute' => '00',
        ]);

        Action::create([
            'type_id' => 2,
            'announcement_id' => 1,
            'customer_id' => 1,
            'owner_id' => 2,
            'services' => '[make-up]',
            'income' => 100,

            'start_date' => '2019-01-06 12:00:00',
            'end_date' => '2019-01-06 13:00:00',
        ]);
        Action::create([
            'type_id' => 2,
            'announcement_id' => 1,
            'customer_id' => 1,
            'owner_id' => 2,
            'services' => '[Manicure hybrydowy, Ściąganie hybrydy]',
            'income' => 135,

            'start_date' => '2019-01-05 11:00:00',
            'end_date' => '2019-01-05 13:00:00',
        ]);
    }
}
