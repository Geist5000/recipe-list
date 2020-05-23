<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class IsNeeded extends Pivot
{
    public $id;
    public $amount;


    public function recipe(){
        return $this->belongsTo(Recipe::class);
    }


    public function ingredient(){
        return $this->belongsTo(Ingredient::class);
    }
}
