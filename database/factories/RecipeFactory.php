<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

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

$factory->define(\App\Recipe::class, function (Faker $faker) {
    return [
        'name' => $faker->streetName,
        'description' => $faker->text(50),
        'tasks' => $faker->text,
        'time' => $faker->time('i:s'),
        'extras' => $faker->text(300)
    ];
});
