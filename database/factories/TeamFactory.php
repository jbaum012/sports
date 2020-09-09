<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Team;
use Faker\Generator as Faker;

$factory->define(Team::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'nickname' => $faker->name(),
        'primary_color' => '#' . $faker->numerify('######'),
        'secondary_color' => '#' . $faker->numerify('######')
    ];
});
