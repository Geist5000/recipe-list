<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    public function recipe(){
        return $this->belongsTo(Recipe::class);
    }
}
