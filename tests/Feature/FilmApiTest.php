<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Film;
use Tests\TestCase;

class FilmApiTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function try_to_test_fetch_all_films()
    {
        Film::factory()->count(3)->create();
        $response = $this->getJson('/api/films');
        $response->assertStatus(200)->assertJsonCount(3);
    }

    /** @test */
    public function try_to_test_create_film()
    {
        $filmData = [
            "title" => "Interstellar",
            "description" => "Sci-fi film",
            "age_rating" => "PG-13",
            "language" => "English",
            "poster_image" => "http://example.com/interstellar.jpg"
        ];
        $response = $this->postJson('/api/films', $filmData);
        $response->assertStatus(201)->assertJsonFragment(["title" => "Interstellar"]);
    }

    /** @test */
    public function try_to_test_fetch_film_by_id()
    {
        $film = Film::factory()->create();
        $response = $this->getJson("/api/films/{$film->id}");
        $response->assertStatus(200)->assertJsonFragment(["title" => $film->title]);
    }

    /** @test */
    public function try_to_test_update_film_by_id()
    {
        $film = Film::factory()->create();
        $updatedData = ["title" => "Updated Title"];
        $response = $this->putJson("/api/films/{$film->id}", $updatedData);
        $response->assertStatus(200)->assertJsonFragment(["title" => "Updated Title"]);
    }

    /** @test */
    public function try_to_test_delete_film()
    {
        $film = Film::factory()->create();
        $response = $this->deleteJson("/api/films/{$film->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('films', ["id" => $film->id]);
    }
}
