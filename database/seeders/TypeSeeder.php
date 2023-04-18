<?php

namespace Database\Seeders;

use Faker\Generator as Faker;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $names = [ "A", "B", "C" ];

        foreach($names as $name) {
            $type = new Type();
            $type->name = $name;
            $type->color = $faker->hexColor();
            $type->save();
        }
    }
}
