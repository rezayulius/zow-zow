<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'digitail' => [
        'client_id' => env('DIGITAIL_CLIENT_ID'),
        'client_secret' => env('DIGITAIL_CLIENT_SECRET'),
        'redirect' => env('DIGITAIL_REDIRECT_URI', env('APP_URL') . '/digitail/auth/callback'),
        'auth_base' => env('DIGITAIL_AUTH_BASE', 'https://identity.digitail.io'), // Configurable Auth URL
        'access_token' => env('DIGITAIL_ACCESS_TOKEN'), // Keep for backward compatibility/fallback
        'api_base' => env('DIGITAIL_API_BASE', 'https://vet.digitail.io/api/v1'),
        'timeout' => env('DIGITAIL_TIMEOUT', 20),
        'default_clinic_id' => env('DIGITAIL_DEFAULT_CLINIC_ID', 3536),
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URI', env('APP_URL') . '/auth/google/callback'),
    ],

    'google_places' => [
        'api_key' => env('GOOGLE_PLACES_API_KEY'),
        'place_id' => env('GOOGLE_PLACES_PLACE_ID'),
        'cache_ttl' => env('GOOGLE_PLACES_CACHE_TTL', 1440),
    ],

];
