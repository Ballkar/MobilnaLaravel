<?php

use Illuminate\Database\Seeder;
use App\Models\Calendar\Work;
use Carbon\Carbon;

class WorksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $startDate = Carbon::now()->hour(14)->minute(30)->second(0);
        $endDate = Carbon::now()->hour(14)->minute(30)->second(0);
        Work::create([
            'owner_id' => '2',
            'customer_id' => '2',
            'start' => $startDate->add(1, 'day'),
            'stop' => $endDate->add(1, 'day')->addHours(2),
        ]);

        $startDate = Carbon::now()->hour(17)->minute(00)->second(0);
        $endDate = Carbon::now()->hour(19)->minute(30)->second(0);
        Work::create([
            'owner_id' => '2',
            'customer_id' => '2',
            'start' => $startDate->add(1, 'day'),
            'stop' => $endDate->add(1, 'day'),
        ]);
    }
}
