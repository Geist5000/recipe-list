<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{

    use HasFactory;
    public function unit(){
        return $this->belongsTo(Unit::class);
    }

    public function recipes(){
        return $this->belongsTo(Recipe::class);
    }
}
