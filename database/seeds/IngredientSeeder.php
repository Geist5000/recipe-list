<?php

use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingredients = factory(\App\Ingredient::class,9)->make();
        $units = factory(\App\Unit::class,3)->create();
        $factor = $ingredients->count() / $units->count();
        $i = 0;
        foreach ($ingredients as $ingredient){
            $ingredient->unit()->associate($units[intval($i/$factor)]);
            $ingredient->save();
            $i++;
        }
    }
}
