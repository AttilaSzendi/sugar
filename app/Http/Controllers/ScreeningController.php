<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScreeningRequest;
use App\Http\Resources\ScreeningResource;
use App\Models\Screening;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ScreeningController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return ScreeningResource::collection(
            Screening::with('movie')->get()
        );
    }

    public function store(ScreeningRequest $request): ScreeningResource
    {
        return new ScreeningResource(
            Screening::query()->create($request->validated())
        );
    }

    public function show(Screening $screening): ScreeningResource
    {
        return new ScreeningResource(
            $screening->load('movie')
        );
    }

    public function update(ScreeningRequest $request, Screening $screening): ScreeningResource
    {
        $screening->update($request->validated());

        return new ScreeningResource($screening);
    }

    public function destroy(Screening $screening): Response
    {
        $screening->delete();

        return response()->noContent();
    }
}
