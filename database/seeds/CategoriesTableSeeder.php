<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name'=>'Rock']);
        Category::create(['name'=>'Pop']);
        Category::create(['name'=>'Metal']);
        Category::create(['name'=>'Alterntive Rock']);
        Category::create(['name'=>'Blues']);
        Category::create(['name'=>'Jazz']);
        Category::create(['name'=>'Metalcore']);
        Category::create(['name'=>'Mashup']);

    }
}
