<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property int id
 * @property string title
 * @property string description
 * @property int age_limit
 * @property string language
 * @property string cover_image
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Collection screenings
 */
class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'age_limit',
        'language',
        'cover_image',
    ];

    public function screenings(): HasMany
    {
        return $this->hasMany(Screening::class);
    }
}
