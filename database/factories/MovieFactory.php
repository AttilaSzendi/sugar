<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'age_limit' => $this->faker->randomElement([0, 6, 12, 16, 18]),
            'language' => $this->faker->randomElement(['English', 'Spanish', 'French', 'German']),
            'cover_image' => $this->faker->imageUrl(200, 300, 'movies'),
        ];
    }
}
