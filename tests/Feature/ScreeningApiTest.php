<?php
namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use App\Models\Movie;
use App\Models\Screening;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScreeningApiTest extends TestCase
{
    use RefreshDatabase;

    #[Test] public function it_can_create_a_screening()
    {
        $movie = Movie::factory()->create();

        $data = [
            'movie_id' => $movie->id,
            'time' => now()->addDays(2)->toDateTimeString(),
            'available_seats' => 100,
        ];

        $response = $this->postJson('/api/screenings', $data);

        $response->assertCreated()
        ->assertJsonFragment(['availableSeats' => 100]);

        $this->assertDatabaseHas('screenings', ['movie_id' => $movie->id]);
    }

    #[Test] public function it_cannot_create_a_screening_with_invalid_data()
    {
        $data = [
            'movie_id' => null,
            'time' => 'invalid-date',
            'available_seats' => -5,
        ];

        $response = $this->postJson('/api/screenings', $data);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['movie_id', 'time', 'available_seats']);
    }

    #[Test] public function it_can_list_screenings()
    {
        Screening::factory()->count(5)->create();

        $response = $this->getJson('/api/screenings');

        $response->assertOk()
            ->assertJsonCount(5, 'data');
    }

    #[Test] public function it_can_show_a_screening()
    {
        $screening = Screening::factory()->create();

        $response = $this->getJson("/api/screenings/{$screening->id}");

        $response->assertOk()
            ->assertJsonFragment(['availableSeats' => $screening->available_seats]);
    }

    #[Test] public function it_can_update_a_screening()
    {
        $screening = Screening::factory()->create();

        $updateData = Screening::factory()->make()->toArray();

        $response = $this->putJson("/api/screenings/{$screening->id}", $updateData);

        $response->assertOk()
            ->assertJsonFragment(['availableSeats' => $updateData['available_seats']]);

        $this->assertDatabaseHas('screenings', [
            'id' => $screening->id,
            'available_seats' => $updateData['available_seats']
        ]);
    }

    #[Test] public function it_can_delete_a_screening()
    {
        $screening = Screening::factory()->create();

        $response = $this->deleteJson("/api/screenings/{$screening->id}");

        $response->assertNoContent();

        $this->assertDatabaseMissing('screenings', ['id' => $screening->id]);
    }
}
