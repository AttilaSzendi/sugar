<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property Carbon time
 * @property int movie_id
 * @property int available_seats
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Movie movie
 */
class Screening extends Model
{
    use HasFactory;

    protected $casts = [
        'time' => 'datetime',
    ];

    protected $fillable = [
        'time',
        'movie_id',
        'available_seats',
    ];

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }
}
