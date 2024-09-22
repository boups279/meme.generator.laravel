<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    /**
     * Create User
     * @param Request $request
     * @return User 
     */
    public function createUser(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make($request->all(), 
            [
                'prenom' => 'required',
                'nom' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'erreur de validation',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'prenom' => $request->prenom,
                'nom' => $request->nom,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Utilisateur créé avec succès',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Login The User
     * @param Request $request
     * @return User
     */

    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), 
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);
    
            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Identifiant ou mot de passe incorrect',
                    'errors' => $validateUser->errors()
                ], 401);
            }
    
            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'L\'e-mail et le mot de passe ne correspondent pas à notre dossier.',
                ], 401);
            }
    
            $user = Auth::user();
    
            // Utilisation de Sanctum pour générer un jeton API
            $token = $user->createToken("API_TOKEN")->plainTextToken;
    
            return response()->json([
                'status' => true,
                'message' => 'Utilisateur connecté avec succès',
                // 'token' => $token,
                'access_token' => $token, 
                'user' => $user
            ], 200);
    
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => true,
            'message' => 'Déconnexion réussie',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
    
} 