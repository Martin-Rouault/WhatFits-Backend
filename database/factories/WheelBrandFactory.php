<?php

namespace Database\Factories;

use App\Models\WheelBrand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WheelBrand>
 */
class WheelBrandFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->company(),
        ];
    }
}
