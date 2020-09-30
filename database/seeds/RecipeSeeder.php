<?php

use App\Recipe;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Recipe::class,10)->create()->each(function ($recipe){
            $recipe->tags()->saveMany(\App\Tag::inRandomOrder()->limit(3)->get());
            $recipe->pictures()->create([
                'path-to-picture' => 'pictures/mehl.jpeg'
            ]);
            $ingredients = \App\Ingredient::inRandomOrder()->limit(5)->get();
            foreach ($ingredients as $ingredient){
                $recipe->ingredients()->save($ingredient,['amount' => 10]);
            }
        });
    }
}
