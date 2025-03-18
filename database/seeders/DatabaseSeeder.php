<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Screening;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Movie::factory(10)->has(Screening::factory()->count(3))->create();
    }
}
