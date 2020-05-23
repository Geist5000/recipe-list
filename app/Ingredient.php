<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    public $id;
    public $unit_id;
    public $name;


    public function unit(){
        return $this->belongsToMany(Unit::class);
    }

    public function recipes(){
        return $this->belongsToMany(Recipe::class)->using(IsNeeded::class);
    }
}
