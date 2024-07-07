<?php

$currentURL = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = require basePath('routes.php');

function routeToController($currentURL, $routes) {
    if (array_key_exists($currentURL, $routes)){
        require basePath($routes[$currentURL]);
    } else {
        abort();
    };
}    

function abort($status = 404){
    http_response_code($status);
    require basePath("views/{$status}.php");
    die();
}

routeToController($currentURL, $routes);