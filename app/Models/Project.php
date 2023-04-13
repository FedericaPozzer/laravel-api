<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; //per lo slug

class Project extends Model
{
    use HasFactory;

    protected $fillable = ["title", "text", "image"];

    public function getAbstract($max = 50) {
        return substr($this->text, 0, $max) . "..";
    }

    public static function generateSlug($title) {
        $possible_slug = Str::of($title)->slug("-");
        $projects = Project::where("slug", $possible_slug)->get();

        $slug = $possible_slug;
        $i = 2;
        while(count($projects)) {
            $possible_slug = $slug . "-" . $i; 
            $projects = Project::where("slug", $possible_slug)->get();
            $i++;
        }

        return $possible_slug;
    }
}

