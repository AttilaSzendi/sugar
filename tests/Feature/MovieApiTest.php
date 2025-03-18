<?php

namespace Tests\Feature;

use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MovieApiTest extends TestCase
{
    use RefreshDatabase;

    #[Test] public function it_can_create_a_movie()
    {
        $data = [
            'title' => 'Inception',
            'description' => 'A mind-bending thriller.',
            'age_limit' => 12,
            'language' => 'English',
            'cover_image' => 'https://example.com/inception.jpg',
        ];

        $response = $this->postJson('/api/movies', $data);

        $response->assertCreated()
            ->assertJsonFragment(['title' => 'Inception']);

        $this->assertDatabaseHas('movies', ['title' => 'Inception']);
    }

    #[Test] public function it_cannot_create_a_movie_with_invalid_data()
    {
        $data = [
            'title' => '',
            'description' => 'A movie.',
            'age_limit' => 25,
            'language' => 'Hungarian',
            'cover_image' => 'invalid-url',
        ];

        $response = $this->postJson('/api/movies', $data);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['title', 'age_limit', 'language', 'cover_image']);
    }

    #[Test] public function it_can_list_movies()
    {
        Movie::factory()->count(3)->create();

        $response = $this->getJson('/api/movies');

        $response->assertOk()->assertJsonCount(3, 'data');
    }

    #[Test] public function it_can_show_a_movie()
    {
        $movie = Movie::factory()->create();

        $response = $this->getJson("/api/movies/{$movie->id}");

        $response->assertOk()->assertJsonFragment(['title' => $movie->title]);
    }

    #[Test] public function it_can_update_a_movie()
    {
        $movie = Movie::factory()->create();

        $updateData = Movie::factory()->make()->toArray();

        $response = $this->putJson("/api/movies/{$movie->id}", $updateData);

        $response->assertOk()->assertJsonFragment(['title' => $updateData['title']]);

        $this->assertDatabaseHas('movies', ['title' => $updateData['title']]);
    }

    #[Test] public function it_can_delete_a_movie()
    {
        $movie = Movie::factory()->create();

        $response = $this->deleteJson("/api/movies/{$movie->id}");

        $response->assertNoContent();

        $this->assertDatabaseMissing('movies', ['id' => $movie->id]);
    }
}
