<?php

return [

    'paths' => ['api/*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [env('FRONTEND_URL'), 'https://every-city-frontend.vercel.app', 'https://www.every-city-frontend.vercel.app', 'http://localhost:5173', 'http://localhost:5174', 'https://everycitymission.co.uk', 'https://www.everycitymission.co.uk'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];
