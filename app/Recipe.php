<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{


    public function pictures(){
        return $this->hasMany(Picture::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function ingredients(){
        return $this->belongsToMany(Ingredient::class,'is_needed')->using(IsNeeded::class)->withPivot('amount');
    }
}
