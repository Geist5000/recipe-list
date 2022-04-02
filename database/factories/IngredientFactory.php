<?php

namespace Database\Factories;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Unit;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use const http\Client\Curl\Features\UNIX_SOCKETS;

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

class IngredientFactory extends Factory{

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'unit_id' => Unit::query()->inRandomOrder()->first()->id,
            'amount' => $this->faker->numberBetween(1,100)
        ];
    }
}

