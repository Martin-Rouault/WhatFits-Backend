<?php

namespace Database\Factories;

use App\Models\CarModel;
use App\Models\Make;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CarModel>
 */
class CarModelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'    => fake()->word(),
            'make_id' => Make::factory(),
        ];
    }
}
