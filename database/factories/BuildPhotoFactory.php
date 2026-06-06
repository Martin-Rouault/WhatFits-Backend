<?php

namespace Database\Factories;

use App\Models\Build;
use App\Models\BuildPhoto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BuildPhoto>
 */
class BuildPhotoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'build_id'      => Build::factory(),
            'photo_url'     => fake()->imageUrl(800, 600, 'cars'),
            'display_order' => fake()->numberBetween(0, 5),
        ];
    }
}
