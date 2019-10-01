<?php
defined('SYSPATH') or die('No direct script access.');

\Route::set('home', '(/)', [], -1)
    ->defaults(
        [
            'controller' => '\\Application\\Controller\\HomeController',
            'action' => 'index'
        ]
    );

// Autoload static frontend pages
$pages = \Kohana::$config->load('pages_routes')->as_array();

if (!empty($pages)) {
    foreach ($pages as $page) {
        \Route::set($page['route_name'], $page['route_uri'], $page['route_parameters'])
            ->filter(
                function ($router, $params, $request) use ($page) {
                    $params['route_name'] = $page['route_name'];

                    return $params;
                }
            )
            ->defaults(
                [
                    'controller' => '\\Pages\\Controller\\PagesController',
                    'action' => 'show',
                    'permalink' => $page['route_name']
                ]
            );
    }
}
