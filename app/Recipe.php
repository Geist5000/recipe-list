<?php

namespace App;

use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "time",
        "description",
        "tasks"
    ];



    public function pictures(){
        return $this->hasMany(Picture::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function ingredients(){
        return $this->hasMany(Ingredient::class);
    }

    /**
     * Get the time as CarbonInterval.
     *
     * @return CarbonInterval
     */
    public function timeAsInterval(): CarbonInterval
    {
        return CarbonInterval::minutes($this->time)->cascade();
    }
}
