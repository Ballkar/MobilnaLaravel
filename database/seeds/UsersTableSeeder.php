<?php

use App\Http\Controllers\Constants\Roles;
use App\Models\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'password' => '123123',
            'role_id' => Roles::ROLE_ADMIN,
            'name' => ''
        ]);
        User::create([
            'email' => 'test@o2.pl',
            'password' => '123123',
            'role_id' => Roles::ROLE_USER,
            'name' => 'Renails',
            'phone' => '508994856',
        ]);
        User::create([
            'email' => 'customer@o2.pl',
            'password' => '123123',
            'role_id' => Roles::ROLE_CLIENT,
            'name' => '',
            'phone' => '508994856',
        ]);
    }
}
