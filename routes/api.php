<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CaptureController;
use App\Http\Controllers\Api\MemesController;
use App\Http\Controllers\sseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Cors;

// Route::middleware(Cors::class)->group(function () {
//     Route::get('/user', function (Request $request) {
//         return $request->user();
//     })->middleware('auth:sanctum');

//     // Login / Register / Deconnexion / Refresh de l'utilisateur
//     Route::post('/auth/register', [AuthController::class, 'createUser']);
//     Route::post('/auth/login', [AuthController::class, 'loginUser']);
//     Route::post('/auth/logout', [AuthController::class, 'logout']);
//     Route::post('/auth/refresh', [AuthController::class, 'refresh']);

//     Route::get('/auth/les_memes', [MemesController::class, 'getMemes']);
//     Route::post('/auth/memes', [MemesController::class, 'store']);

//     Route::middleware('auth:sanctum')->group(function () {
//         Route::get('/auth/memes/user/{userId}', [MemesController::class, 'getMemesByUser']);

//         Route::get('/user', function (Request $request) {
//             return $request->user();
//         });
//     });
// });


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Login / Register / Deconnexion / Refrech / de l'utilisateur
Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);
Route::post('/auth/logout', [AuthController::class, 'logout']);
Route::post('/auth/refresh', [AuthController::class, 'refresh']);
Route::get('/getData', [sseController::class, 'index']);

Route::get('/auth/les_memes', [MemesController::class, 'getMemes']);

Route::post('/auth/memes', [MemesController::class, 'store']);
// Route::post('/auth/save-capture', [CaptureController::class, 'store']);

Route::middleware('auth:sanctum')->get('/captures', [CaptureController::class, 'index']);
// // Recuperer les categories
// Route::get('categories', [CategoriesController::class, 'get_categorie']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth/memes/user/{userId}', [MemesController::class, 'getMemesByUser']);
    Route::post('/auth/save-capture', [CaptureController::class, 'saveCapture']);
    Route::get('/auth/captures', [CaptureController::class, 'index']);


    // // Ajouter une livre
    // Route::post('books/create', [BooksController::class, 'ajouter_livre']);

    // //Ajouter une categorie
    // Route::post('categories/create', [CategoriesController::class, 'cat']);


    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
