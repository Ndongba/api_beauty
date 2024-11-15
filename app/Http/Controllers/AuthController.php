<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Professionnel;
use App\Models\ImageProfessionnel;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB; // Ajout de l'import pour DB

class AuthController extends Controller
{
    // Méthode pour l'inscription
    public function register(Request $request)
    {
        Log::info('Début de la requête d\'inscription', $request->all());

        // Validation des données
        $validator = Validator::make($request->all(), [
            //  'name' => ['required', 'string', 'max:255'],
            //  'password' => ['required', 'string', 'max:255'],
            //  'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //  'registre_commerce' => 'required_if:role,professionnel|file|mimes:pdf,jpg,jpeg,png|max:2048',
            //  'ninea' => 'required_if:role,professionnel|file|mimes:pdf,jpg,jpeg,png|max:2048',
            //  'telephone' => ['required', 'regex:/^\+?[1-9]\d{1,10}$/'],
            //  'adresse' => ['required', 'string', 'max:255'],
            //  'role' => 'required|string|in:admin,client,professionnel',
            //  'images' => 'required_if:role,professionnel|array|max:3',
            //  'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            //  'disponibilites' => 'required_if:role,professionnel|array',
            //  'disponibilites.*.jour' => 'required_if:role,professionnel|string|in:lundi,mardi,mercredi,jeudi,vendredi,samedi,dimanche',
            //  'disponibilites.*.heure_ouverture' => 'required_if:role,professionnel|date_format:H:i',
            //  'disponibilites.*.heure_fermeture' => 'required_if:role,professionnel|date_format:H:i',

        ]);

        // Gestion des erreurs de validation
        if ($validator->fails()) {
            Log::error('Erreur de validation', ['errors' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            DB::beginTransaction();

            // 1. Création de l'utilisateur
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Log::info('Utilisateur créé avec succès', ['user_id' => $user->id]);

            $user->assignRole($request->role);

            // 2. Traitement pour les professionnels
            if ($request->role === 'professionnel') {
                $professionnelData = [
                    'user_id' => $user->id,
                    'telephone' => $request->telephone,
                    'adresse' => $request->adresse,
                ];

                // Gestion des fichiers pour le registre de commerce et le NINEA
                if ($request->hasFile('registre_commerce')) {
                    $registreCommercePath = $request->file('registre_commerce')
                        ->store('uploads/registre_commerce', 'public');
                    $professionnelData['registre_commerce'] = $registreCommercePath;
                }

                if ($request->hasFile('ninea')) {
                    $nineaPath = $request->file('ninea')
                        ->store('uploads/ninea', 'public');
                    $professionnelData['ninea'] = $nineaPath;
                }

                // Upload des images
                $imagePaths = []; // Tableau pour stocker les chemins des images
                if ($request->hasFile('images')) {
                    Log::info('Début du traitement des images', [
                        'nombre_images' => count($request->file('images'))
                    ]);

                    foreach ($request->file('images') as $index => $image) {
                        try {
                            // Générer un nom unique pour l'image
                            $imageName = time() . '_' . $index . '_' . $image->getClientOriginalName();

                            // Stocker l'image avec le nom généré
                            $path = $image->storeAs('professionnels', $imageName, 'public');
                            $imagePaths[] = $path;

                            Log::info('Image stockée avec succès', [
                                'path' => $path,
                                'index' => $index
                            ]);
                        } catch (\Exception $e) {
                            Log::error('Erreur lors du traitement de l\'image', [
                                'index' => $index,
                                'error' => $e->getMessage()
                            ]);
                            throw $e;
                        }
                    }
                }

                // Créer le professionnel
                $professionnel = Professionnel::create($professionnelData);
                Log::info('Professionnel créé avec succès', ['professionnel_id' => $professionnel->id]);

                 // Ajout des disponibilités
        foreach ($request->disponibilites as $disponibilite) {
            $professionnel->disponibilites()->create([
                'jour' => $disponibilite['jour'],
                'heure_ouverture' => $disponibilite['heure_ouverture'],
                'heure_fermeture' => $disponibilite['heure_fermeture'],
            ]);
        }


                // Enregistrer les images dans la table `images_professionnels`
                foreach ($imagePaths as $index => $path) {
                    ImageProfessionnel::create([
                        'professionnel_id' => $professionnel->id,
                        'image_path' => $path,
                        'image_type' => 'galerie',
                        'ordre' => $index + 1
                    ]);

                    Log::info('Entrée créée dans la table `images_professionnels`', [
                        'path' => $path
                    ]);
                }
            }

            // 3. Traitement pour les clients
            elseif ($request->role === 'client') {
                Client::create([
                    'user_id' => $user->id,
                    'adresse' => $request->adresse,
                    'telephone' => $request->telephone,
                ]);
            }

            DB::commit();
            Log::info('Inscription terminée avec succès');

            return response()->json([
                'success' => true,
                'message' => 'Inscription réussie',
                'user' => $user
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de l\'inscription', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de l\'inscription',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Méthode pour la connexion de l'utilisateur
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        Log::info('Tentative de connexion avec les credentials : ', $credentials);

        if (!$token = JWTAuth::attempt($credentials)) {
            Log::error('Échec de la tentative de connexion : Identifiants incorrects');
            return response()->json(['error' => 'Identifiants incorrects'], 401);
        }

        $user = auth()->user();

        if (!$user) {
            Log::error('Utilisateur non trouvé pour les credentials : ', $credentials);
            return response()->json(['error' => 'Utilisateur non trouvé'], 404);
        }

        Log::info('Utilisateur connecté : ', ['user_id' => $user->id]);
        $roles = $user->getRoleNames();

        return response()->json([
            "access_token" => $token,
            "token_type" => "bearer",
            "user" => $user,
            "roles" => $roles,
        ]);
    }

    // Méthode pour récupérer les informations de l'utilisateur connecté
    public function me()
    {
        $user = auth()->user();
        $roles = $user->getRoleNames();

        return response()->json([
            "user" => $user,
            "roles" => $roles,
        ]);
    }

    // Méthode pour déconnecter l'utilisateur
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Déconnexion réussie']);
    }

    // Méthode pour formater la réponse avec le token
    protected function respondWithToken($token)
    {
        $user = Auth::user();
        $roles = $user->roles;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'roles' => $roles,
            ],
        ]);
    }
}
