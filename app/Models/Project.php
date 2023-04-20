<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; //per lo slug

class Project extends Model
{
    use HasFactory;

    protected $fillable = ["title", "text", "image", "type_id"];

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

    public function getImage() {
        return $this->image ? asset("storage/" . $this->image) : "https://t3.ftcdn.net/jpg/02/48/42/64/360_F_248426448_NVKLywWqArG2ADUxDq6QprtIzsF82dMF.jpg";
    }

    // Relazioni

    public function technologies() {
        return $this->belongsToMany(Technology::class);
    }

    public function type() {
        return $this->belongsTo(Type::class);
    }
}