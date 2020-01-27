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
            'text' => $faker->text(200),
            'user_id' => 1,
            'active' => '1',
            'category_id' => 1
        ]);

        Post::create([
            'title' => 'Drugi wpis',
            'text' => $faker->text(200),
            'user_id' => 1,
            'active' => '1',
            'category_id' => 1
        ]);

        Post::create([
            'title' => 'Trzeci wpis',
            'text' => $faker->text(200),
            'user_id' => 1,
            'active' => '1',
            'category_id' => 3
        ]);

        Post::create([
            'title' => 'Czwarty wpis',
            'text' => $faker->text(200),
            'user_id' => 1,
            'active' => '1',
            'category_id' => 2
        ]);
        Post::create([
            'title' => 'piąty',
            'text' => $faker->text(200),
            'user_id' => 1,
            'active' => '1',
            'category_id' => 3
        ]);
        Post::create([
            'title' => 'six',
            'text' => $faker->text(250),
            'user_id' => 1,
            'active' => '1',
            'category_id' => 2
        ]);
        Post::create([
            'title' => 'sieeeedem',
            'text' => $faker->text(350),
            'user_id' => 1,
            'category_id' => 2
        ]);

        Post::create([
            'title' => 'Ostatni',
            'text' => $faker->text(200),
            'user_id' => 1,
            'active' => '1',
            'category_id' => 1
        ]);
    }
}
