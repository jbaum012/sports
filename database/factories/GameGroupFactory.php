<?php

namespace Database\Factories;

use App\Models\GameGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameGroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GameGroup::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'label' => "Week {$this->faker->numerify('##')}"
        ];
    }
}
