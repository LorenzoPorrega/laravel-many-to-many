<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $technologies = ["HTML", "CSS", "SCSS", "Bootstrap", "Tailwind", "JavaScript", "Vue", "PHP", "Laravel"];
        
        foreach ($technologies as $technology) {
            $new_tech = new Technology();

            $new_tech->name = $technology;
            $new_tech->color = $faker->rgbColor();

            $new_tech->save();
        }
    }
}