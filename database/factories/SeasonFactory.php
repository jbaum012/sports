<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Season;
use Faker\Generator as Faker;

$factory->define(Season::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'score_card_cost' => $faker->numerify('#00'),
        'max_double_down' => $faker->numberBetween(1, 10)
    ];
});
