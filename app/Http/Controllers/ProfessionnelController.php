<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfessionnelRequest;
use App\Http\Requests\UpdateProfessionnelRequest;
use App\Models\Professionnel;
use App\Models\User;
use Illuminate\Http\Request;

class ProfessionnelController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  */

    public function index()
    {
        // Récupérer tous les utilisateurs ayant le rôle "professionnel"
        $professionnels = User::role('professionnel') // Filtrer par rôle "professionnel"
                              ->with(['professionnel'])
                              ->get();

        return response()->json($professionnels);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfessionnelRequest $request)
    {
        // Créer un professionnel avec les données validées
        $professionnel = Professionnel::create($request->validated());

        // Ajouter des images ou d'autres relations, si nécessaire
        if ($request->has('images')) {
            $professionnel->images()->createMany($request->input('images'));
        }

        return response()->json(['message' => 'Professionnel créé avec succès', 'professionnel' => $professionnel], 201);
    }

    /**
     * Display the specified resource.
     */
      public function show($id)
      {
          // Afficher un professionnel avec ses images
          $professionnel = Professionnel::findOrFail($id);
          return response()->json($professionnel);
      }






    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfessionnelRequest $request, $id)
    {
        // Mettre à jour les informations d'un professionnel
        $professionnel = Professionnel::findOrFail($id);
        $professionnel->update($request->validated());

        // Mettre à jour les images si elles sont fournies
        if ($request->has('images')) {
            // Supprimer les anciennes images et ajouter les nouvelles
            $professionnel->images()->delete();
            $professionnel->images()->createMany($request->input('images'));
        }

        return response()->json(['message' => 'Professionnel mis à jour avec succès', 'professionnel' => $professionnel], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Supprimer un professionnel et toutes ses relations associées
        $professionnel = Professionnel::findOrFail($id);
        $professionnel->delete();

        return response()->json(['message' => 'Professionnel supprimé avec succès'], 200);
    }
}
