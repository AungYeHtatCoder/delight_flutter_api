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

    // 'paths' => ['api/*', 'sanctum/csrf-cookie'],

    // 'allowed_methods' => ['*'],

    // 'allowed_origins' => ['*'],

    // 'allowed_origins_patterns' => [],

    // 'allowed_headers' => ['*'],

    // 'exposed_headers' => [],

    // 'max_age' => 0,

  
        // //'max_age' => 60 * 60 * 24, // Cache for 1 day
        // 'supports_credentials' => true,
    //     'paths' => ['api/*', 'sanctum/csrf-cookie'],
    //     // 'paths' => [
    //     //             'api/*', 
    //     //             'sanctum/csrf-cookie'
    //     //         ],
    //     'allowed_methods' => ['*'],
    //     //'allowed_origins' => ['http://localhost:3000'],
    //    // 'allowed_origins' => ['*'],
    //    'allowed_origins' => ['http://localhost:3000', 'http://127.0.0.1:8000'],
    //     'allowed_origins_patterns' => ['*'],
    //     'allowed_headers' => ['*'],
    //     'exposed_headers' => [],
    //     'max_age' => 0, // You asked about this - setting it to 0 means no caching of preflight request
    //     'supports_credentials' => true,
     'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    //'allowed_origins' => ['*'],
    'allowed_origins' => ['*'],


    'allowed_origins_patterns' => [],

    //'allowed_headers' => ['*'],
    'allowed_headers' => ['Content-Type', 'X-Requested-With', 'Authorization'],
    

   // 'exposed_headers' => [],
    'exposed_headers' => ['Authorization'],

    'max_age' => 0,

    'supports_credentials' => true,



];