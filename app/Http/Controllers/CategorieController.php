<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;
use App\Models\Categorie;
use Illuminate\Http\JsonResponse;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(Categorie::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategorieRequest $request): JsonResponse
    {
        $categorie = Categorie::create($request->validated());

        return response()->json($categorie, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $categorie = Categorie::find($id);

        if (!$categorie) {
            return response()->json(['message' => 'Categorie not found'], 404);
        }

        return response()->json($categorie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategorieRequest $request, Categorie $categorie): JsonResponse
{


    $categorie->update($request->validated());

    return response()->json($categorie,201);
}

public function destroy($id): JsonResponse
{
    $categorie = Categorie::findOrFail($id);

    $categorie->delete();

    return response()->json(['message' => 'Categorie deleted successfully']);
}

}
