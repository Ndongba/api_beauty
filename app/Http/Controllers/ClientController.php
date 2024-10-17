<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer tous les clients
        $clients = Client::all();
        return response()->json($clients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        // Validation et création d'un nouveau client
        $validatedData = $request->validated();

        $client = Client::create($validatedData);

        return response()->json([
            'message' => 'Client créé avec succès.',
            'client' => $client
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Récupérer un client spécifique par son ID
        $client = Client::find($id);

        if (!$client) {
            return response()->json(['message' => 'Client non trouvé.'], 404);
        }

        return response()->json($client);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, $id)
    {
        // Mettre à jour un client
        $client = Client::find($id);

        if (!$client) {
            return response()->json(['message' => 'Client non trouvé.'], 404);
        }

        $validatedData = $request->validated();
        $client->update($validatedData);

        return response()->json([
            'message' => 'Client mis à jour avec succès.',
            'client' => $client
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Supprimer un client
        $client = Client::find($id);

        if (!$client) {
            return response()->json(['message' => 'Client non trouvé.'], 404);
        }

        $client->delete();

        return response()->json(['message' => 'Client supprimé avec succès.']);
    }
}
