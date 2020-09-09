<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Game;
use Faker\Generator as Faker;

$factory->define(Game::class, function (Faker $faker) {
    return [
        'season_id' => fn () => factory('App\Season')->create()->id,
        'starts_at' => $faker->dateTime(),
        'home_team_id' => fn () => factory('App\Team')->create()->id,
        'away_team_id' => fn () => factory('App\Team')->create()->id,
    ];
});
