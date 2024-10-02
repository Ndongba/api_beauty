<?php

namespace App\Http\Controllers;

use App\Models\ImageProduit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageProduitController extends Controller
{
    public function index()
    {
        return ImageProduit::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' // Image max 2 Mo
        ]);

        // Stockage de l'image
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('produits', 'public'); // Enregistre dans `storage/app/public/produits`

            $image = ImageProduit::create([
                'produit_id' => $validated['produit_id'],
                'image_path' => $path
            ]);

            return response()->json($image, 201);
        }

        return response()->json(['error' => 'Aucune image uploadée.'], 400);
    }

    public function show($id)
    {
        return ImageProduit::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $imageProduit = ImageProduit::findOrFail($id);

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            Storage::disk('public')->delete($imageProduit->image_path);

            // Mettre à jour avec la nouvelle image
            $path = $request->file('image')->store('produits', 'public');
            $imageProduit->update(['image_path' => $path]);
        }

        return response()->json($imageProduit);
    }

    public function destroy($id)
    {
        $imageProduit = ImageProduit::findOrFail($id);

        // Supprimer l'image du stockage
        Storage::disk('public')->delete($imageProduit->image_path);

        // Supprimer l'entrée de la base de données
        $imageProduit->delete();

        return response()->json(['message' => 'Image supprimée avec succès.']);
    }
}
