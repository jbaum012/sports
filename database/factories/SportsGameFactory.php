<?php

namespace Database\Factories;

use App\Models\GameGroup;
use App\Models\SportsGame;
use App\Models\SportsTeam;
use Illuminate\Database\Eloquent\Factories\Factory;

class SportsGameFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SportsGame::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'game_group_id' => GameGroup::factory()->create()->id,
            'home_team_id' => SportsTeam::factory()->create()->id,
            'away_team_id' => SportsTeam::factory()->create()->id,
            'starts_at' => $this->faker->dateTimeThisYear($max = '2022-02-01', $timezone = 'America/Chicago'),
        ];
    }
}
