<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *     schema="Screening",
 *     title="Screening",
 *     description="Vetítés adatmodell",
 *     required={"showtime", "available_seats", "film_id"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="showtime", type="string", format="date-time", example="2025-06-15T20:00:00Z"),
 *     @OA\Property(property="available_seats", type="integer", example=50),
 *     @OA\Property(property="film_id", type="integer", example=1),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class Screening extends Model
{
    use HasFactory;

    protected $fillable = [
        'film_id',
        'showtime',
        'available_seats',
    ];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}
