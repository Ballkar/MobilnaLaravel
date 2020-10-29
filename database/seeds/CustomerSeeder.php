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
            'surname' => 'Błaszczyk',
            'phone' => '515414768',
            'owner_id' => '2',
        ]);

        Customer::create([
            'name' => 'Kasia',
            'surname' => 'Kowalczyk',
            'phone' => '515414768',
            'owner_id' => '2',
        ]);

    }
}
