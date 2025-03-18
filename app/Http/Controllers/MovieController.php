<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class MovieController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return MovieResource::collection(
            Movie::query()->paginate()
        );
    }

    public function store(MovieRequest $request): MovieResource
    {
        return new MovieResource(
            Movie::query()->create($request->validated())
        );
    }

    public function show(Movie $movie): MovieResource
    {
        return new MovieResource(
            $movie->load('screenings')
        );
    }

    public function update(MovieRequest $request, Movie $movie): MovieResource
    {
        $movie->update($request->validated());

        return new MovieResource($movie);
    }

    public function destroy(Movie $movie): Response
    {
        $movie->delete();

        return response()->noContent();
    }
}
