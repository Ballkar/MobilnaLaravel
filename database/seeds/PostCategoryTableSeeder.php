<?php

use App\Models\Blog\Category as Category;
use Illuminate\Database\Seeder;

class PostCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Pierwsze Kroki'
        ]);
        Category::create([
            'name' => 'Zdrowie i choroby'
        ]);
        Category::create([
            'name' => 'Produkty'
        ]);
    }
}
