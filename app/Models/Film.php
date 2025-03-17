<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *     schema="Film",
 *     title="Film",
 *     description="Film adatmodell",
 *     required={"title", "description", "rating", "language", "cover_image"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Jurassic Park"),
 *     @OA\Property(property="description", type="string", example="Egy dinoszaurusz park története."),
 *     @OA\Property(property="rating", type="string", example="PG-13"),
 *     @OA\Property(property="language", type="string", example="English"),
 *     @OA\Property(property="cover_image", type="string", format="url", example="https://example.com/jurassic-park.jpg"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'age_rating',
        'language',
        'poster_image',
    ];

    public function screenings()
    {
        return $this->hasMany(Screening::class);
    }
}
