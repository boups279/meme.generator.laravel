<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Memes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class MemesController extends Controller
{
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:20480', // Corrigez ici
    //     ]);


    //     // Stocker l'image
    //     $path = $request->file('image')->store('images', 'public');

    //     $userId = 1;
    //     // Auth::id();
    //     // dd($userId); 

    //     if (!$request->hasFile('image')) {
    //         return response()->json(['message' => 'No image uploaded'], 422);
    //     }


    //     if (!$userId) {
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }

    //     $meme = new Memes();
    //     $meme->user_id = $userId;
    //     $meme->name = $request->name;
    //     $meme->populaire = 1;
    //     $meme->image_path = $path;
    //     $meme->save();

    //     return response()->json($meme, 201);
    // }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:8048', // Image validation
        ]);


        // Sauvegarde de l'image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('memes', 'public'); // Sauvegarde dans public/storage/memes


            $userId = 1;

            // Sauvegarder le chemin dans la base de données
            $meme = new Memes();
            $meme->user_id = $userId;
            $meme->populaire = 1;
            $meme->name = $request->input('name');
            $meme->image = $imagePath;
            $meme->save();


            return response()->json([
                'message' => 'Meme ajouté avec succès',
                'imagePath' => $imagePath
            ], 200);
        } else {
            return response()->json(['message' => 'Aucune image trouvée'], 422);
        }
    }


    public function getMemes()
    {
        $memes = Memes::select('id', 'name', 'image', 'created_at')->get();

        // Ajouter l'URL de l'image à chaque meme
        $memes->map(function ($meme) {
            $meme->image_url = Storage::url($meme->image);
            return $meme;
        });

        return response()->json($memes);
    }

    public function getMemesByUser($userId)
    {
        $userId = Auth::id();
        $memes = Memes::where('user_id', $userId)->get();

        // Ajouter l'URL de l'image à chaque meme
        $memes->map(function ($meme) {
            $meme->image_url = Storage::url($meme->image);
            return $meme;
        });

        return response()->json($memes);
    }
}
