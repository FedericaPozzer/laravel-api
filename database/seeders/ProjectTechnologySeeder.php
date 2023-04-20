<?php

namespace Database\Seeders;

use Faker\Generator as Faker;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectTechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $projects = Project::all(); //prendo tutti i projects (oggetto project)
        $technologies = Technology::all()->pluck("id")->toArray(); //prendo larrey di ID delle tecnologies

        foreach($projects as $project) {
            //per OGNI project dammi un numero casuale di technologies da 0 a 2
            $project->technologies()->attach($faker->randomElements($technologies, random_int(0, 2)));
            //randonElements al plurale perchè se no ne stampa solo uno (non legge il secondo parametro)
        }
    }
}
