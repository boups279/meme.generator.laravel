<?php

return [

    'paths' => ['*'],  // Les routes qui doivent autoriser les requêtes CORS
    // 'paths' => ['api/*', 'sanctum/csrf-cookie', '/login'],  // Les routes qui doivent autoriser les requêtes CORS

    'allowed_methods' => ['*'],  // Les méthodes HTTP autorisées (GET, POST, etc.)

    // 'allowed_origins' => ['*'],  // Les origines autorisées. Remplacez '*' par les origines spécifiques si nécessaire, comme 'http://localhost:4200'.

    // 'allowed_origins' => ['https://laravel.meme-generator.boups.tech'],

    'allowed_origins' => ['*'],

    'allowed_origins_patterns' => [],  // Les patterns d'origines autorisées (utilisez des expressions régulières si besoin).

    'allowed_headers' => ['*'],  // Les en-têtes autorisés.

    // 'exposed_headers' => [],  // Les en-têtes exposés au navigateur.

    'allowed_headers' => ['Content-Type', 'X-Requested-With', 'Authorization'],


    'max_age' => 0,  // Le temps de mise en cache de la réponse préliminaire OPTIONS.

    'supports_credentials' => true,  // Si vous devez autoriser l'authentification (cookies, tokens, etc.).

];
