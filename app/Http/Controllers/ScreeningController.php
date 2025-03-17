<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Screening;

/**
 * @OA\Tag(
 *     name="Screenings",
 *     description="Vetítések kezelése"
 * )
 */
class ScreeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
     * @OA\Get(
     *     path="/api/screenings",
     *     summary="Összes vetítés lekérdezése",
     *     tags={"Screenings"},
     *     @OA\Response(
     *         response=200,
     *         description="Sikeres válasz",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Screening"))
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Screening::with('film')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * @OA\Post(
     *     path="/api/screenings",
     *     summary="Új vetítés létrehozása",
     *     tags={"Screenings"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Screening")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Vetítés sikeresen létrehozva"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'film_id' => 'required|exists:films,id',
            'showtime' => 'required|date',
            'available_seats' => 'required|integer|min:1',
        ]);

        $screening = Screening::create($validated);
        return response()->json($screening, 201);
    }

    /**
     * Display the specified resource.
     */
    /**
     * @OA\Get(
     *     path="/api/screenings/{id}",
     *     summary="Egy adott vetítés lekérdezése",
     *     tags={"Screenings"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="A vetítés egyedi azonosítója",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sikeres válasz",
     *         @OA\JsonContent(ref="#/components/schemas/Screening")
     *     )
     * )
     */
    public function show(string $id)
    {
        $screening = Screening::with('film')->find($id);
        if (!$screening) {
            return response()->json(['message' => 'Screening not found'], 404);
        }
        return response()->json($screening);
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * @OA\Put(
     *     path="/api/screenings/{id}",
     *     summary="Egy adott vetítés módosítása",
     *     tags={"Screenings"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="A vetítés egyedi azonosítója",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Screening")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Vetítés sikeresen frissítve"
     *     )
     * )
     */
    public function update(Request $request, string $id)
    {
        $screening = Screening::find($id);
        if (!$screening) {
            return response()->json(['message' => 'Screening not found'], 404);
        }

        $validated = $request->validate([
            'film_id' => 'sometimes|exists:films,id',
            'showtime' => 'sometimes|date',
            'available_seats' => 'sometimes|integer|min:1',
        ]);

        $screening->update($validated);
        return response()->json($screening);
    }

    /**
     * Remove the specified resource from storage.
     */
    /**
     * @OA\Delete(
     *     path="/api/screenings/{id}",
     *     summary="Egy adott vetítés törlése",
     *     tags={"Screenings"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="A vetítés egyedi azonosítója",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Vetítés sikeresen törölve"
     *     )
     * )
     */
    public function destroy(string $id)
    {
        $screening = Screening::find($id);
        if (!$screening) {
            return response()->json(['message' => 'Screening not found'], 404);
        }

        $screening->delete();
        return response()->json(['message' => 'Screening deleted successfully']);
    }
}
