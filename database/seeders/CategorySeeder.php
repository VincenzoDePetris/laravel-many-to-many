<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;

use Faker\Generator as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $_categories=[
            'Progetto bello',
            'Progetto medio-bello',
            'Progetto bellissimo',
            'Progetto brutto',
        ];

        foreach($_categories as $_category){
            $category = new Category();
            $category->label = $_category;
            $category->color = $faker->hexColor();
            $category->save();
        }
    }
}
