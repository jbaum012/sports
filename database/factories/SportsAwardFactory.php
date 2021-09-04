<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\GameGroup;
use App\Models\SportsBet;
use App\Models\SportsAward;
use Illuminate\Database\Eloquent\Factories\Factory;

class SportsAwardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SportsAward::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'description' => $this->faker->sentence(),
            'icon' => $this->faker->randomElement([
                '&#129411;',
                '&#128005;',
                '&#128069;',
                '&#127942;'
            ]),
            'background_color' => $this->faker->randomElement([
                '#CD5C5C',
                '#40E0D0',
                '#6495ED',
                'lime',
                'rgb(0, 255, 255)',
                'purple',
                'rgb(128, 0, 0)'
            ]),
            'game_group_id' => GameGroup::factory(),
            'sports_bet_id' => SportsBet::factory(),
            'user_id' => User::factory()
        ];
    }
}
