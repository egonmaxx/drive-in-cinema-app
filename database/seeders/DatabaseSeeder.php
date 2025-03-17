<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Film::factory(10)->create()->each(function ($film) {
            $film->screenings()->saveMany(\App\Models\Screening::factory(3)->make());
        });

        // Film::factory(10)->create()->each(function ($film) {
        //     Screening::factory(3)->create(['film_id' => $film->id]);
        // });

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
