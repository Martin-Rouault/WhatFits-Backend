<?php

namespace Database\Factories;

use App\Models\Build;
use App\Models\CarModel;
use App\Models\User;
use App\Models\Wheel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Build>
 */
class BuildFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'      => User::factory(),
            'car_model_id' => CarModel::factory(),
            'wheel_id'     => Wheel::factory(),
            'car_year'     => fake()->numberBetween(2000, 2024),
            'diameter'     => fake()->numberBetween(16, 22),
            'width'        => fake()->randomFloat(1, 7.0, 10.5),
        ];
    }
}
