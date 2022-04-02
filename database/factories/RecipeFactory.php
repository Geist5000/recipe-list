<?php

namespace Database\Factories;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
class RecipeFactory extends Factory{

    public function definition()
    {
        return [
            'name' => $this->faker->streetName,
            'description' => $this->faker->text(50),
            'tasks' => $this->faker->text,
            'time' => $this->faker->numberBetween(40,4000),
            'extras' => $this->faker->text(300)
        ];
    }
}
