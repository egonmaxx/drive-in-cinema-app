<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Screening;
use App\Models\Film;

class ScreeningApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function try_to_test_fetch_all_screenings()
    {
        Screening::factory()->count(3)->create();
        $response = $this->getJson('/api/screenings');
        $response->assertStatus(200)->assertJsonCount(3);
    }

    /** @test */
    public function try_to_test_create_screening()
    {
        $film = Film::factory()->create();
        $screeningData = [
            "film_id" => $film->id,
            "showtime" => now()->addDays(1)->toDateTimeString(),
            "available_seats" => 100
        ];
        $response = $this->postJson('/api/screenings', $screeningData);
        $response->assertStatus(201)->assertJsonFragment(["film_id" => $film->id]);
    }

    /** @test */
    public function try_to_test_fetch_screening_by_id()
    {
        $film = Film::factory()->create();
        $screening = Screening::factory()->create();
        $response = $this->getJson("/api/screenings/{$screening->id}");
        $response->assertStatus(200)->assertJsonFragment(["id" => $screening->id]);
    }

    /** @test */
    public function try_to_test_update_screening()
    {
        $screening = Screening::factory()->create();
        $updatedData = ["available_seats" => 50];
        $response = $this->putJson("/api/screenings/{$screening->id}", $updatedData);
        $response->assertStatus(200)->assertJsonFragment(["available_seats" => 50]);
    }

    /** @test */
    public function try_to_test_delete_screening()
    {
        $screening = Screening::factory()->create();
        $response = $this->deleteJson("/api/screenings/{$screening->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('screenings', ["id" => $screening->id]);
    }
}
