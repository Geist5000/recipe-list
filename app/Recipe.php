<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    public $id;
    public $time;
    public $name;
    public $description;
    public $extras;


    public function pictures(){
        return $this->hasMany(Picture::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function ingredients(){
        return $this->belongsToMany(Ingredient::class)->using(IsNeeded::class);
    }
}
