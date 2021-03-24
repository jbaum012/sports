<?php

namespace Database\Factories;

use App\Models\SportsTeam;
use Illuminate\Database\Eloquent\Factories\Factory;

class SportsTeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SportsTeam::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'location' => $this->faker->city(),
            'abbreviation' => $this->faker->lexify('???'),
            'division' => $this->faker->randomElement([
                'NFC North',
                'NFC South',
                'NFC East',
                'NFC West',
                'AFC North',
                'AFC South',
                'AFC East',
                'AFC West'
            ]),
            'primary_color' => '#' . $this->faker->numerify('######'),
            'secondary_color' => '#' . $this->faker->numerify('######')
        ];
    }
}
