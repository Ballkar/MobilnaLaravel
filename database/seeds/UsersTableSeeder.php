<?php

use App\Http\Controllers\Constants\Roles;
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
                'password' => Hash::make('admin123'),
                'role_id' => Roles::ROLE_ADMIN,
                'name' => ''
            ]
        );
        DB::table('users')->insert(
            [
                'email' => 'test@o2.pl',
                'password' => Hash::make('test123'),
                'role_id' => Roles::ROLE_USER,
                'name' => ''
            ]
        );
        DB::table('users')->insert(
            [
                'email' => 'klient@o2.pl',
                'password' => Hash::make('test123'),
                'role_id' => Roles::ROLE_CLIENT,
                'name' => ''
            ]
        );
    }
}
