<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Professionnel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{



//     public function register(Request $request)
// {
//     // Validation des données
//     $validator = validator($request->all(), [
//         'name' => ['required', 'string', 'max:255'],
//         'password' => ['required', 'string', 'max:255'],
//         'role_id' => 'required|exists:roles,id', // Validation pour role_id
//         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//         'registre_commerce' => 'required_if:role_id,3|file|mimes:pdf,jpg,jpeg,png|max:2048',
//         'ninea' => 'required_if:role_id,3|file|mimes:pdf,jpg,jpeg,png|max:2048',
//         'telephone' => ['required', 'integer'],
//         'adresse' => ['required', 'string', 'max:255']
//     ]);

//     if ($validator->fails()) {
//         return response()->json([
//             'success' => false,
//             'errors' => $validator->errors(),
//         ], 422);
//     }

//     try {
//         // Créer l'utilisateur
//         $user = User::create([
//             'name' => $request->name,
//             'email' => $request->email,
//             'password' => Hash::make($request->password),
//             'role_id' => $request->role_id,
//         ]);

//         // Enregistrement dans la table appropriée en fonction du rôle
//         if ($request->role_id == 3) { // Rôle professionnel
//             $professionnelData = [
//                 'user_id' => $user->id,
//             ];

//             // Traitement des fichiers d'upload pour le professionnel
//             if ($request->hasFile('registre_commerce')) {
//                 $registreCommercePath = $request->file('registre_commerce')->store('uploads/registre_commerce');
//                 $professionnelData['registre_commerce'] = $registreCommercePath;
//             }

//             if ($request->hasFile('ninea')) {
//                 $nineaPath = $request->file('ninea')->store('uploads/ninea');
//                 $professionnelData['ninea'] = $nineaPath;
//             }

//             Professionnel::create($professionnelData);
//         } elseif ($request->role_id == 2) { // Rôle client
//             Client::create([
//                 'user_id' => $user->id,
//                 'adresse' => $request->adresse, // Correction ici pour utiliser $request->adresse
//                 'telephone' => $request->telephone, // Utilisation correcte de $request->telephone
//             ]);
//         }

//         return response()->json([
//             'success' => true,
//             'message' => 'Inscription réussie',
//             'user' => $user
//         ], 201);
//     } catch (\Exception $e) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Une erreur est survenue : ' . $e->getMessage()
//         ], 500);
//     }
// }
public function register(Request $request)
{
    // Validation des données
    $validator = validator($request->all(), [
        'name' => ['required', 'string', 'max:255'],
        'password' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'registre_commerce' => 'required_if:role_id,3|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'ninea' => 'required_if:role_id,3|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'telephone' => ['required', 'integer'],
        'adresse' => ['required', 'string', 'max:255'],
        'role' => 'required|string|in:admin,client,professionnel' // Par exemple
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ], 422);
    }

    try {
        // Créer l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Associer le rôle à l'utilisateur
        $user->assignRole($request->role);

        // Enregistrement dans la table appropriée en fonction du rôle
        if ($request->role === 'professionnel') { // Rôle professionnel
            $professionnelData = [
                'user_id' => $user->id,
            ];

            // Traitement des fichiers d'upload pour le professionnel
            if ($request->hasFile('registre_commerce')) {
                $registreCommercePath = $request->file('registre_commerce')->store('uploads/registre_commerce');
                $professionnelData['registre_commerce'] = $registreCommercePath;
            }

            if ($request->hasFile('ninea')) {
                $nineaPath = $request->file('ninea')->store('uploads/ninea');
                $professionnelData['ninea'] = $nineaPath;
            }

            Professionnel::create($professionnelData);
        } elseif ($request->role === 'client') { // Rôle client
            Client::create([
                'user_id' => $user->id,
                'adresse' => $request->adresse,
                'telephone' => $request->telephone,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Inscription réussie',
            'user' => $user
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Une erreur est survenue : ' . $e->getMessage()
        ], 500);
    }
}

    // Connexion de l'utilisateur
    public function login(Request $request)
    {
        // Validation des informations de connexion
        $credentials = $request->only('email', 'password');

        // Ajout d'un log pour vérifier les credentials
        Log::info('Tentative de connexion avec les credentials : ', $credentials);

        if (!$token = JWTAuth::attempt($credentials)) {
            Log::error('Échec de la tentative de connexion : Identifiants incorrects');
            return response()->json(['error' => 'Identifiants incorrects'], 401);
        }

        $user = auth()->user();

        // Vérification si l'utilisateur est trouvé
        if (!$user) {
            Log::error('Utilisateur non trouvé pour les credentials : ', $credentials);
            return response()->json(['error' => 'Utilisateur non trouvé'], 404);
        }

        // Ajout d'un log pour vérifier l'utilisateur
        Log::info('Utilisateur connecté : ', ['user_id' => $user->id]);

        // Récupérer les rôles de l'utilisateur
        $roles = $user->getRoleNames(); // Méthode Spatie pour obtenir les noms de rôles

        // Ajout d'un log pour vérifier les rôles
        Log::info('Rôles de l\'utilisateur : ', ['roles' => $roles]);

        // Renvoyer le token d'authentification
        return response()->json([
            "access_token" => $token,
            "token_type" => "bearer",
            "user" => $user,
            "roles" => $roles,
        ]);
    }


    // // Retourne les informations de l'utilisateur connecté
    // public function me()
    // {
    //     $user = Auth::user();

    //     // Obtenir les rôles de l'utilisateur sans utiliser load
    //      $roles = $user->roles; // Supposant que cette relation existe




    //     return response()->json([
    //         'id' => $user->id,
    //         'name' => $user->name,
    //         'email' => $user->email,
    //         'roles' => $roles, // Accès direct à la relation
    //     ]);
    // }

     public function me() {
         // Récupérer l'utilisateur authentifié
         $user = auth()->user();

    //     // Récupérer les rôles de l'utilisateur
         $roles = $user->getRoleNames(); // Méthode Spatie pour obtenir les noms de rôles

    //     // Renvoyer les informations du user avec ses rôles et le prénom
         return response()->json([
            "user" => $user,
             "roles" => $roles,
         ]);
      }
    // public function me() {
    //     // Récupérer l'utilisateur authentifié
    //     $user = auth()->user();

    //     // Récupérer les rôles de l'utilisateur
    //     $roles = $user->getRoleNames(); // Méthode Spatie pour obtenir les noms de rôles

    //     // Variable pour stocker le prénom
    //     $prenom = null;

    //     // Vérification des rôles et récupération du prénom dans la table correspondante
    //     if ($roles->contains('professeur')) {
    //         // Si l'utilisateur est un professeur
    //         $professeur = $user->professeur; // Relation avec la table 'professeurs'
    //         $prenom = $professeur ? $professeur->prenom : null;
    //     } elseif ($roles->contains('parent')) {
    //         // Si l'utilisateur est un parent
    //         $parent = $user->parent; // Relation avec la table 'parents'
    //         $prenom = $parent ? $parent->prenom : null;
    //     } elseif ($roles->contains('eleve')) {
    //         // Si l'utilisateur est un élève
    //         $eleve = $user->eleve; // Relation avec la table 'eleves'
    //         $prenom = $eleve ? $eleve->prenom : null;
    //     }

    //     // Renvoyer les informations du user avec ses rôles et le prénom
    //     return response()->json([
    //         "user" => $user,
    //         "roles" => $roles,
    //         "prenom" => $prenom
    //     ]);
    // }
    // Déconnexion de l'utilisateur
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Déconnexion réussie']);
    }

    // Formate la réponse avec le token
    protected function respondWithToken($token)
    {
        $user = Auth::user();
        $roles = $user->roles; // Accéder directement aux rôles ici aussi

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'roles' => $roles, // Récupérer les rôles sans load
            ],
        ]);
    }
}
