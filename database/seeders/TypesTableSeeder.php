<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TypesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(Faker $faker): void
  {
    $types = ["Full Stack", "Front End", "Back End", "Design", "DevOps"];

    foreach ($types as $singleType){
      $new_type = new Type();

      $new_type->name = $singleType;
      $new_type->color = $faker->rgbColor();

      $new_type->save();
    }
  }
}
