<?php

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
                'role_id' => '1',
                'name' => ''
            ]
        );
        DB::table('users')->insert(
            [
                'email' => 'test@o2.pl',
                'password' => Hash::make('test123'),
                'role_id' => '1',
                'name' => ''
            ]
        );
    }
}
