<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ajouter les en-têtes CORS
        $response = $next($request);
        
        // Autoriser l'origine spécifique
        $response->headers->set('Access-Control-Allow-Origin', 'https://meme-generator.boups.tech');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization');

        // Si la requête est une requête OPTIONS, renvoyer une réponse vide avec un code 204
        if ($request->isMethod('OPTIONS')) {
            return response()->json([], 204);
        }

        return $response;
    }
}
