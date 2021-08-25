<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\GameGroup;
use App\Models\SportsBet;
use App\Models\SportsGame;
use Illuminate\Database\Eloquent\Factories\Factory;

class SportsBetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SportsBet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'game_group_id' => GameGroup::factory(),
            'sports_game_id' => SportsGame::factory(),
            'user_id' => User::factory(),
            'doubled' => false
        ];
    }
}
