<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Type;

use Illuminate\Support\Str; //per lo slug
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $types = Type::all()->pluck("id")->toArray(); // genero array con tutti gli ID del TYPES disponibili (aggiungo toArray perchè se no mi arriva una collection)

        for($i=0; $i < 30; $i++) {
        $project = new Project;
        $project->type_id = $faker->randomElement($types);
        $project->title = $faker->catchPhrase(); 
        $project->slug = Str::of($project->title)->slug("-");
        $project->text = $faker->paragraph(3);
        // $project->image = "https://picsum.photos/700/500";

        $project->save();
        }
    }
}

// per svuotare la tabella dai seed di prova e ri-seeddarla:
// php artisan migrate:fresh --seed