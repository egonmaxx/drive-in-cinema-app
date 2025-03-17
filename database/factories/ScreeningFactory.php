<?php

namespace Database\Factories;

use App\Models\Screening;
use App\Models\Film;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Screening>
 */
class ScreeningFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'film_id' => Film::factory(), // Egy új Film-et hoz létre hozzá
            'showtime' => $this->faker->dateTimeBetween('+1 days', '+1 month'), // Vetítés időpontja a következő 1 hónapban
            'available_seats' => $this->faker->numberBetween(20, 100), // 20 és 100 közötti szabad helyek
        ];
    }
}
