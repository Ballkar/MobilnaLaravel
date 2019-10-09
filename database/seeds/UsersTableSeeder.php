<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'admin@o2.pl',
            'password' => 'admin123',
            'role_id' => '1'
        ]);

        User::create([
            'email' => 'test@o2.pl',
            'password' => 'test123',
            'role_id' => '2'
        ]);
    }
}
