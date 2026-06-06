<?php

namespace Database\Factories;

use App\Models\Wheel;
use App\Models\WheelBrand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Wheel>
 */
class WheelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'           => fake()->word(),
            'wheel_brand_id' => WheelBrand::factory(),
        ];
    }
}
