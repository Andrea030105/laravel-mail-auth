<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {

        for ($i = 0; $i < 7; $i++) {
            $newTechnologie = new Technology();

            $newTechnologie->name = $faker->word();
            $newTechnologie->slug = Str::slug($newTechnologie->name, '-');

            $newTechnologie->save();
        }
    }
}
