<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Week;
use Faker\Generator as Faker;

$factory->define(Week::class, function (Faker $faker) {
    return [
        'starts' => $faker->dateTime(),
        'number' => $faker->numberBetween(1, 18),
    ];
});
