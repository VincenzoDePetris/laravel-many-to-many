<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Work;
use App\Models\Tag;

use Faker\Generator as Faker;

class WorkTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $works = Work::all();                       
        $tags = Tag::all()->pluck('id')->toArray();
      
        foreach($works as $work) {
          $work->
            tags()->
                attach($faker->randomElements($tags, random_int(0, 4)));
        }
    }
}
