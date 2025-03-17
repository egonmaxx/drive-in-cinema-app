<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
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
            'age_rating' => $this->faker->randomElement(['PG', 'PG-13', 'R']),
            'language' => $this->faker->randomElement(['English', 'French', 'German']),
            'poster_image' => $this->faker->imageUrl(),
        ];
    }
}
