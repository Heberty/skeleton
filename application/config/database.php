<?php defined('SYSPATH') OR die('No direct access allowed.');

return [
    'production' => [
        'dbname' => env('DATABASE_NAME', 'dev_database'),
        'user' => env('DATABASE_USER', 'root'),
        'password' => env('DATABASE_PASSWORD', 'root'),
        'host' => env('DATABASE_HOST', 'localhost'),
        'driver' => env('DATABASE_DRIVER', 'pdo_mysql'),
        'charset' => env('DATABASE_CHARSET', 'utf8')
    ],
    'development' => [
        'dbname' => env('DATABASE_NAME', 'dev_database'),
        'user' => env('DATABASE_USER', 'root'),
        'password' => env('DATABASE_PASSWORD', 'root'),
        'host' => env('DATABASE_HOST', 'localhost'),
        'driver' => env('DATABASE_DRIVER', 'pdo_mysql'),
        'charset' => env('DATABASE_CHARSET', 'utf8')
    ],
];
