<?php

namespace Routes;

require_once('autoload.php');

class Router
{
    private static array $routes;
    
    public static function get($uri, $controller, $classMethod)
    {
        self::$routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'class' => $classMethod,
            'method' => 'GET'
        ];
    }

    public static function post($uri, $controller, $classMethod)
    {
        self::$routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'class' => $classMethod,
            'method' => 'POST'
        ];
    }

    public static function delete($uri, $controller, $classMethod)
    {
        self::$routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'class' => $classMethod,
            'method' => 'DELETE'
        ];
    }

    public static function getRoutes()
    {
        return self::$routes;
    }
}
