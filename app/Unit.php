<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{

    public function ingredients(){
        return $this->hasMany(Ingredient::class);
    }
}
