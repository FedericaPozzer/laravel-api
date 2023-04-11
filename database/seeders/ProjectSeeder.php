<?php

namespace Database\Seeders;

use App\Models\Project;
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
        for($i=0; $i < 30; $i++) {
        $project = new Project;

        $project->title = $faker->catchPhrase(); 
        $project->slug = Str::of($project->title)->slug("-");
        $project->text = $faker->paragraph(3);
        $project->image = "https://picsum.photos/700/500";

        $project->save();
        }
    }
}

// per svuotare la tabella dai seed di prova:
// php artisan migrate:fresh --seed