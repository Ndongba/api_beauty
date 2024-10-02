<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\ImageProduit;
use App\Http\Requests\StoreProduitRequest;
use App\Http\Requests\UpdateProduitRequest;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Produit::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProduitRequest $request)
    {
        // Créer un nouveau produit avec les données validées
        $produit = Produit::create($request->validated());

        return response()->json($produit, 201);

         // Valider le formulaire d'upload
    $validated = $request->validate([
        'produit_id' => 'required|exists:produits,id',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' // Les fichiers doivent être des images et max 2 Mo
    ]);

    // Vérifier si un fichier est présent dans la requête
    if ($request->hasFile('image')) {
        // Récupérer le fichier image
        $file = $request->file('image');

        // Stocker l'image dans le dossier `public/produits`
        $path = $file->store('produits', 'public'); // Sauvegarde dans `storage/app/public/produits`

        // Enregistrer le chemin de l'image dans la base de données
        ImageProduit::create([
            'produit_id' => $validated['produit_id'],
            'image_path' => $path, // Enregistrer le chemin relatif
        ]);

        return response()->json(['message' => 'Image uploadée avec succès!', 'path' => $path], 201);
    }

    return response()->json(['message' => 'Aucun fichier trouvé.'], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(Produit $produit)
    {
        return response()->json($produit);

        $produit = Produit::with('images')->findOrFail($id);
        return response()->json($produit);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProduitRequest $request, Produit $produit)
    {
        // Mettre à jour le produit existant avec les nouvelles données validées
        $produit->update($request->validated());

        return response()->json($produit);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
    {
        $produit->delete();

        return response()->json(['message' => 'Produit deleted successfully']);
    }
}
