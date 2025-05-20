<?php

define('APP_DIR', dirname(__DIR__));
require APP_DIR . '/vendor/autoload.php';
$routes = require APP_DIR . '/config/routes.php';

// router, will be replaced
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

if (isset($routes[$requestUri])) {
    $route = $routes[$requestUri];
    list($controllerName, $actionName) = explode('@', $route);
    
    $controllerClassName = "App\\Controllers\\{$controllerName}";
    $controller = new $controllerClassName();
    $controller->$actionName();
} else {
    header("HTTP/1.0 404 Not Found");
    echo "Page not found";
}