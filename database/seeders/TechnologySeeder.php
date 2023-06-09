<?php

namespace Database\Seeders;

use App\Models\Technology;
use Faker\Generator as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $names = [ "Alfa", "Bravo", "Charlie" ];

        foreach($names as $name) {
            $type = new Technology();
            $type->name = $name;
            $type->color = $faker->hexColor();
            $type->save();
        }
    }
}
