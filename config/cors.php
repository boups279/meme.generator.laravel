<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['*'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];


// return [
//     'paths' => ['*'], // Autorise tous les chemins ou spécifie les routes spécifiques
//     'allowed_methods' => ['*'], // Autorise toutes les méthodes HTTP
//     'allowed_origins' => ['http://localhost:3000', 'http://user-client'], // Remplace par tes URL autorisées
//     'allowed_origins_patterns' => [],
//     'allowed_headers' => ['*'], // Autorise tous les en-têtes
//     'exposed_headers' => [],
//     'max_age' => 0,
//     'supports_credentials' => true, // Si tu utilises des cookies ou des sessions partagées
// ];

