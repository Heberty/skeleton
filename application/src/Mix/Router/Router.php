<?php
namespace Mix\Router;

class Router
{
    public static function getRouteUrl($route, array $params = null, $protocol = null)
    {
        return \URL::site(\Route::get($route)->uri($params), $protocol);
    }
}
