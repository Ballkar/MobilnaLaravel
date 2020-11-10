<?php

use App\Http\Controllers\Constants\Roles;
use App\Models\Message\MessageSetting;
use Illuminate\Database\Seeder;
use App\Models\User;
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
        DB::table('users')->insert(
            [
                'email' => 'admin@o2.pl',
                'password' => Hash::make('123123'),
                'role_id' => Roles::ROLE_ADMIN,
                'name' => ''
            ]
        );
        DB::table('users')->insert(
            [
                'email' => 'user@o2.pl',
                'password' => Hash::make('123123'),
                'role_id' => Roles::ROLE_USER,
                'name' => 'Miss Megi',
                'phone' => '508994856',
            ]
        );
        MessageSetting::create([
            'owner_id' => 2,
        ]);

        DB::table('users')->insert(
            [
                'email' => 'test@o2.pl',
                'password' => Hash::make('123123'),
                'role_id' => Roles::ROLE_USER,
                'name' => 'Renails',
                'phone' => '508994856',
            ]
        );
        MessageSetting::create([
            'owner_id' => 3,
        ]);
        DB::table('users')->insert(
            [
                'email' => 'customer@o2.pl',
                'password' => Hash::make('123123'),
                'role_id' => Roles::ROLE_CLIENT,
                'name' => '',
                'phone' => '508994856',
            ]
        );
    }
}
