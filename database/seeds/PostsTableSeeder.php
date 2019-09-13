<?php

use App\Models\Blog\Category as Category;
use App\Models\Blog\Post as Post;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        Post::create([
            'title' => 'Pierwsze Kroki',
            'text' => $faker->text(100),
            'user_id' => 1,
            'category_id' => 1
        ]);

        Post::create([
            'title' => 'Drugi wpis',
            'text' => $faker->text(100),
            'user_id' => 1,
            'category_id' => 1
        ]);
    }
}
