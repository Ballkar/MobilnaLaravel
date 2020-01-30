<?php

use App\Models\Announcement\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create([
            'name' => 'Ania',
            'phone' => '515414768',
            'owner_id' => '2',
        ]);

        Customer::create([
            'user_id' => '3',
            'owner_id' => '2',
        ]);

    }
}
