<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PostCategoryTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(ServiceGroupsTableSeeder::class);
        $this->call(CalendarActionTypesSeeder::class);
        $this->call(InitializationSeeder::class);
    }
}
