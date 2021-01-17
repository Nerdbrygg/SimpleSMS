<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Values
    |--------------------------------------------------------------------------
    |
    | Default provider is PSWinCom.
    |
    | Default Source is based on .env file
    |
    */
    'default' => [
        'provider' => 'PSWinCom',
        'countryCode' => 47,
        'source' => env('SIMPLESMS_SOURCE', 'SimpleSMS'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Message settings
    |--------------------------------------------------------------------------
    |
    | Setting 'save' (boolean) determines if you want to save the SMS in the database.
    |
    | Setting 'encryption' (boolean) determines if you want do encrypt the `message` field in the database.
    |   - Uses Laravel's builtin encrypt() function. Should be decryptable with decrypt() function.
    |
    */
    'messages' => [
        'save' => true,
        'encrypt' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Provider settings
    |--------------------------------------------------------------------------
    |
    |
    |
    */
    'provider' => [
        'username' => env('SIMPLESMS_USERNAME'),
        'password' => env('SIMPLESMS_PASSWORD'),
    ],
];
