<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Payment IPG
    |--------------------------------------------------------------------------
    |
     */

    'IPG_service' => env('PAYMENT_IPG_SERVICE', 'pasargad'),

    'payment_method' => env('PAYMENT_IPG_METHOD', 'credentials'),

    'pasargad' => [
        'endpoint' => 'https://pasargad.com/quarkino',
        'api-token' => env('PAYMENT_TOKEN'),
        'credentials' => [
            'username' => env('PASARGAD_USERNAME'),
            'password' => env('PASSARGAD_PASSWORD')
        ]
    ],

    'parsian' => [
        'endpoint' => 'https://parsian.com/quarkino',
        'api-token' => env('PAYMENT_TOKEN'),
        'credentials' => [
            'username' => env('PARSIAN_USERNAME'),
            'password' => env('PARSIAN_PASSWORD')
        ]
    ],
];
