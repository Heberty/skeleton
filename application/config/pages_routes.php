<?php defined('SYSPATH') OR die('No direct access allowed.');

return [
    [
        'route_name' => 'interna',
        'route_uri'  => 'interna',
        'route_parameters' => [],
        'view' => 'pages/interna',
        'filter' => function(\Mix\Controller\Controller $controller, \View $view) {}
    ]
];
