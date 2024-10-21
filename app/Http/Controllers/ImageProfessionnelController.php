<?php

namespace App\Http\Controllers;

use App\Models\ImageProfessionnel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageProfessionnelController extends Controller
{
    public function index()
    {
        return ImageProfessionnel::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'professionnel_id' => 'required|exists:professionnels,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('professionnels', 'public');

            $image = ImageProfessionnel::create([
                'professionnel_id' => $validated['professionnel_id'],
                'image_path' => $path

            ]);

            return response()->json($image, 201);
        }

        return response()->json(['error' => 'Aucune image uploadée.'], 400);
    }

    public function show($id)
    {
        return ImageProfessionnel::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $ImageProfessionnel = ImageProfessionnel::findOrFail($id);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($ImageProfessionnel->image_path);

            $path = $request->file('image')->store('professionnels', 'public');
            $ImageProfessionnel->update(['image_path' => $path]);
        }

        return response()->json($ImageProfessionnel);
    }

    public function destroy($id)
    {
        $ImageProfessionnel = ImageProfessionnel::findOrFail($id);

        Storage::disk('public')->delete($ImageProfessionnel->image_path);

        $ImageProfessionnel->delete();

        return response()->json(['message' => 'Image supprimée avec succès.']);
    }
}
