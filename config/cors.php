<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    'allowed_methods' => ['*'],
    'allowed_origins' => [
        'http://localhost:3000',
        'http://localhost:3001',
        'http://portfolio-admin.test:8888',
        'http://iam-sso-core.test:8888',
        'https://adamth.vercel.app',
        'https://cleanly.biz.id',
    ],
    'allowed_origins_patterns' => [
        '#^https://.*\.vercel\.app$#',
        '#^https://.*\.cleanly\.biz\.id$#',
    ],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,
];
