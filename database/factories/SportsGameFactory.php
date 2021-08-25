<?php

namespace Database\Factories;

use App\Models\User;
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
            'game_group_id' => GameGroup::factory(),
            'home_team_id' => SportsTeam::factory(),
            'away_team_id' => SportsTeam::factory(),
            'created_by' => User::factory(),
            'starts_at' => $this->faker->dateTimeThisYear($max = '2022-02-01', $timezone = 'UTC'),
        ];
    }

    public function isTied()
    {
        return $this->state(function (array $attributes) {
            return [
                'home_team_score' => 7,
                'away_team_score' => 7
            ];
        });
    }

    public function homeWins()
    {
        return $this->state(function (array $attributes) {
            return [
                'home_team_score' => 10,
                'away_team_score' => 7
            ];
        });
    }

    public function awayWins()
    {
        return $this->state(function (array $attributes) {
            return [
                'home_team_score' => 7,
                'away_team_score' => 10
            ];
        });
    }
}
