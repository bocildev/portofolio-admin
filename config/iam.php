<?php

return [
    'issuer' => env('IAM_ISSUER', env('IAM_BASE_URL', 'http://iam-sso-core.test:8888')),
    'client_id' => env('IAM_CLIENT_ID', 'app_portfolio_admin'),
    'redirect_uri' => env('IAM_REDIRECT_URI', 'http://portfolio-admin.test:8888/auth/callback'),
    'post_logout_uri' => env('IAM_POST_LOGOUT_URI', 'http://portfolio-admin.test:8888/login'),
    'porto_url' => env('IAM_PORTO_URL', 'http://localhost:3000'),
    'webhook_secret' => env('IAM_WEBHOOK_SECRET', ''),
];
