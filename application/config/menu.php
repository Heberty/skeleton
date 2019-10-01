<?php

use Mix\Router\Router;

return [
    [
        'title' => 'Sobre',
        'uri'  => Router::getRouteUrl('pages.show', ['permalink' => 'sobre']),
        'weight' => 10
    ]
];
