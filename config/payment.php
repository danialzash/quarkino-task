<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Payment IPG
    |--------------------------------------------------------------------------
    |
     */

    'default' => env('IPG', 'pasargad'),

    'pasargad' => [
        'gateway' => 'https://pasargad.com/quarkino',
        'api-token' => env('PASARGAD_TOKEN')
    ],

    'parsian' => [
        'gateway' => 'https://parsian.com/quarkino',
        'api-token' => env('PARSIAN_TOKEN')
    ],
];
