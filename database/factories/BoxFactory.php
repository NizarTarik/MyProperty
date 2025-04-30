<?php

namespace Database\Factories;

use App\Models\Box;
use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Box>
 */

class BoxFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Box::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'like' => true,
            'bookmark' => $this->faker->boolean(),
            'user_id' => User::factory()->create()->id,
            'property_id' => Property::factory()->create()->id,
        ];
    }
}
