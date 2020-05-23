<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    public $id;


    public function recipe(){
        return $this->belongsTo(Recipe::class);
    }
}
