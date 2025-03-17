<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;

/**
 * @OA\Tag(
 *     name="Films",
 *     description="Filmek kezelése"
 * )
 */
class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
     * @OA\Get(
     *     path="/api/films",
     *     summary="Összes film lekérdezése",
     *     tags={"Films"},
     *     @OA\Response(
     *         response=200,
     *         description="Sikeres válasz",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Film"))
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Film::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * @OA\Post(
     *     path="/api/films",
     *     summary="Új film létrehozása",
     *     tags={"Films"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Film")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Film sikeresen létrehozva"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'age_rating' => 'required|string|max:10',
            'language' => 'required|string|max:50',
            'poster_image' => 'nullable|string',
        ]);

        $film = Film::create($validated);
        return response()->json($film, 201);
    }

    /**
     * Display the specified resource.
     */
    /**
     * @OA\Get(
     *     path="/api/films/{id}",
     *     summary="Egy adott film lekérdezése",
     *     tags={"Films"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="A film egyedi azonosítója",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sikeres válasz",
     *         @OA\JsonContent(ref="#/components/schemas/Film")
     *     )
     * )
     */
    public function show(string $id)
    {
        $film = Film::find($id);
        if (!$film) {
            return response()->json(['message' => 'Film not found'], 404);
        }
        return response()->json($film);
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * @OA\Put(
     *     path="/api/films/{id}",
     *     summary="Egy adott film módosítása",
     *     tags={"Films"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="A film egyedi azonosítója",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Film")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Film sikeresen frissítve"
     *     )
     * )
     */
    public function update(Request $request, string $id)
    {
        $film = Film::find($id);
        if (!$film) {
            return response()->json(['message' => 'Film not found'], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'age_rating' => 'sometimes|string|max:10',
            'language' => 'sometimes|string|max:50',
            'poster_image' => 'nullable|string',
        ]);

        $film->update($validated);
        return response()->json($film);
    }

    /**
     * Remove the specified resource from storage.
     */
    /**
     * @OA\Delete(
     *     path="/api/films/{id}",
     *     summary="Egy adott film törlése",
     *     tags={"Films"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="A film egyedi azonosítója",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Film sikeresen törölve"
     *     )
     * )
     */
    public function destroy(string $id)
    {
        $film = Film::find($id);
        if (!$film) {
            return response()->json(['message' => 'Film not found'], 404);
        }

        $film->delete();
        return response()->json(['message' => 'Film deleted successfully']);
    }
}
