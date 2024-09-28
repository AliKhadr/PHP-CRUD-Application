<?php

use Core\Session;
use Core\ValidationException;

session_start();

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'Core/functions.php';

spl_autoload_register(function ($class) { 
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    require basePath("{$class}.php");
});

require basePath('bootstrap.php');

// New Router class
use Core\Router;
$router = new Router;

$routes = require basePath('routes.php');

$currentURL = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = isset($_POST['_method']) ? $_POST['_method'] : $_SERVER['REQUEST_METHOD'];


try {
    $router->route($currentURL, $method);
} catch(ValidationException $exception) {
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->oldData);
    return redirect($router->previousURL());
}


Session::unflash();
