<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    public function pictures(){
        return $this->hasMany(Picture::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function ingredients(){
        return $this->hasMany(Ingredient::class);
    }
}
