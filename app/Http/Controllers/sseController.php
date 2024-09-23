<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class sseController extends Controller
{
    public function index()
    {
        $response = new StreamedResponse(function () {
            $data = json_encode(['message' => 'This is a message']);

            echo "data: $data\n\n";

            // Vide les tampons de sortie
            ob_flush();
            flush();
        });

        // Définir les en-têtes appropriés pour SSE
        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache');
        $response->headers->set('Connection', 'keep-alive');

        return $response;
    }
}
