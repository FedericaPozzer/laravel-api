<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ["name", "color"];

    // Relazioni

    public function projects() {
        return $this->hasMany(Project::class);
    }

    // HTML
    public function getTypeHTML() {
        return '<span class="badge rounded-pill" style="background-color:' . $this->color . '"> ' . $this->name . '</td></span>';
    }
}
