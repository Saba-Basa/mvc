<?php

define('APP_DIR', dirname(__DIR__));
require APP_DIR . '/vendor/autoload.php';
$routes = require APP_DIR . '/config/routes.php';
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

$matchedRoute = null;
$parameters = [];

if (isset($routes[$requestUri])) {
    $matchedRoute = $routes[$requestUri];
} else {
    foreach ($routes as $routePattern => $handler) {
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9_]+)', $routePattern);
        $pattern = '#^' . $pattern . '$#';

        if (preg_match($pattern, $requestUri, $matches)) {
            $matchedRoute = $handler;
            array_shift($matches);
            $parameters = $matches;
            break;
        }
    }
}

if ($matchedRoute) {
    list($controllerName, $actionName) = explode('@', $matchedRoute);

    $controllerClassName = "App\\Controllers\\{$controllerName}";
    $controller = new $controllerClassName();
    if (!empty($parameters)) {
        call_user_func_array([$controller, $actionName], $parameters);
    } else {
        $controller->$actionName();
    }
} else {
    header("HTTP/1.0 404 Not Found");
    echo "Page not found";
}