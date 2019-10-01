<?php

return [
    'default' => [
        'host' => env('SMTP_HOST'),
        'username' => env('SMTP_USER'),
        'password' => env('SMTP_PASSWORD'),
        'security' => env('SMTP_SECURITY', null),
        'port' => env('SMTP_PORT', 465)
    ]
];
