<?php

require_once('autoload.php');

use Routes\Router;
use Controllers\ProductController;

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$postMethod = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

//add new routes here
Router::get('/', ProductController::class, 'index');
Router::delete('/product', ProductController::class, 'delete');

Router::get('/add_product', ProductController::class, 'add');
Router::post('/product', ProductController::class, 'create');

$allRoutes = Router::getRoutes();

foreach ($allRoutes as $routes) {
    if ($routes['uri'] === $uri && $routes['method'] === strtoupper($postMethod)) {
        $controller = new $routes['controller']();
        $method = $routes['class'];
        $controller->$method();
    }
}
