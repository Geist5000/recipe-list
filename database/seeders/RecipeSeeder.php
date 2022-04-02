<?php

namespace Database\Seeders;

use App\Ingredient;
use App\Picture;
use App\Recipe;
use App\Tag;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $recipe = Recipe::factory()
                ->has(Picture::factory()->count(1))
                ->has(Ingredient::factory()->count(5))
                ->create();
            $recipe->tags()->saveMany(Tag::query()->inRandomOrder()->limit(2)->get());
        }

    }
}
