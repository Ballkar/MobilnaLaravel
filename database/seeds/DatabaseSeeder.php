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
        $this->call(CalendarSeeder::class);
        $this->call(AnnouncementsSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(ActionsSeeder::class);
    }
}
