<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bet;
use Faker\Generator as Faker;

$factory->define(Bet::class, function (Faker $faker) {
    $game = factory('App\Game')->create();
    return [
        'game_id' => $game->id,
        'user_id' => fn () => factory('App\User')->create()->id,
        'team_id' => $game->home_team_id,
        'double_down' => $faker->boolean()
    ];
});
