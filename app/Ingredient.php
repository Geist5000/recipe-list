<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{



    public function unit(){
        return $this->belongsTo(Unit::class);
    }

    public function recipes(){
        return $this->belongsToMany(Recipe::class)->using(IsNeeded::class);
    }
}
