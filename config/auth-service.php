<?php

return [
    'hadirauth' => [
        'client_id' => env('OAUTH_CLIENT_ID'),
        'client_secret' => env('OAUTH_CLIENT_SECRET'),
        'redirect' => env('OAUTH_CLIENT_REDIRECT_URI'),
        'base_uri' => env('OAUTH_BASE_URI'),
        'organization_id' => env('OAUTH_ORGANIZATION_ID'),
        'app_id' => env('OAUTH_APP_ID'),
        'auth_uri' => env('OAUTH_AUTHORIZE_URI', '/login/oauth/authorize'),
        'token_uri' => env('OAUTH_TOKEN_URI', '/api/login/oauth/access_token'),
        'user_info_uri' => env('OAUTH_USER_URI', '/api/userinfo'),
    ],
];
