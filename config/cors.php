<?php

return [
    'paths' => ['api/*', 'qrCode/*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['http://localhost:5173'], // URL do React
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];
