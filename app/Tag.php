<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $id;
    public $name;
    public function recipes(){
        return $this->belongsToMany(Recipe::class);
    }
}
