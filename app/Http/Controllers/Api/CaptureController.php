<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Capture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CaptureController extends Controller
{
    // public function saveCapture(Request $request)
    // {
    //     $request->validate([
    //         'image' => 'required|string',
    //     ]);

    //     $capture = new Capture();
    //     $capture->image = $request->input('image');
    //     $capture->save();

    //     return response()->json(['message' => 'Capture enregistrée avec succès.'], 201);
    // }

    public function saveCapture(Request $request)
    {
        $request->validate([
            'image' => 'required|string',
        ]);

        $imageData = $request->input('image');
        // Enlève le préfixe de type de l'image
        $imageData = str_replace('data:image/png;base64,', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);
        $imageName = 'captures/' . uniqid() . '.png';
        Storage::disk('public')->put($imageName, base64_decode($imageData));

        $capture = new Capture();
        $capture->image = $imageName;
        $capture->user_id = Auth::id();
        $capture->save();

        return response()->json(['message' => 'Capture enregistrée avec succès.'], 201);
    }

    public function index()
    {
        // Récupérer les captures de l'utilisateur authentifié
        $captures = Capture::where('user_id', Auth::id())->get();
        return response()->json($captures);
    }
}
