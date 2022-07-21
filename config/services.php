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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'instagram_api' => [
        'token' => 'EAAIiQ9ViUaIBAJnWIbUVZA27breHT5zNyplZASPaRxJZAZBT5WaFpPPu5tTbMT1BCG3E3bKPnKH1zlo9ZAZCEofBUjVB6EP3NRvMPsEJH81zXyZCAyYpuDGNrqGJz7yiwtNIEueXN0oKj7sMpsB9PIec7F4TfIhFVANk0RPeiA1WZByBI0Ujfh3NxsCxxmPY9SavFM2ZAF3bmwZBMgchsO35ZCV', // paste your access token inside quotes
    ],

];
