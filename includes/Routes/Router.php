<?php

namespace Routes;

require_once('autoload.php');

class Router
{
    private static array $routes;

    public static function route(string $uri, string $controller)
    {
        self::$routes[$uri] = $controller;
    }

    public static function getRoutes()
    {
        return self::$routes;
    }
}
