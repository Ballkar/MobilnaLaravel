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
            'name' => 'Arek',
            'surname' => 'Łatka',
            'phone' => '608581667',
            'owner_id' => '2',
        ]);

        Customer::create([
            'name' => 'Renata',
            'surname' => 'Zwolińska',
            'phone' => '48537966826',
            'owner_id' => '2',
        ]);

    }
}
