<?php

require_once('autoload.php');

use Routes\Router;
use Controllers\AddProduct;
use Controllers\ListProduct;

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

//add new routes here
Router::route('/', ListProduct::class);
Router::route('/add_product', AddProduct::class);

$allRoutes = Router::getRoutes();
if (array_key_exists($uri, $allRoutes)) {

    //IF THE CONTROLLER IS STATIC
    // call_user_func($allRoutes[$uri] . 'CONTROLLER_METHOD');

    //IF YOU DONT WANT TO RUN THE CONTROLLER AS STATIC
    $controller = new $allRoutes[$uri]();
    // $method = CONTROLLER_METHOD;
    // $controller->$method();
} else {
    require_once('./public/views/404.view.php');
}
