<?php

$currentURL = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    '/'=> 'controllers/index.php',
    '/notes'=> 'controllers/notes.php',
    '/note'=> 'controllers/note.php',
    '/about'=> 'controllers/about.php',
    '/contact'=> 'controllers/contact.php',
];

function routeToController($currentURL, $routes) {
    if (array_key_exists($currentURL, $routes)){
        require $routes[$currentURL];
    } else {
        abort();
    };
}    

function abort($status = 404){
    http_response_code($status);
    require "views/{$status}.php";
    die();
}


routeToController($currentURL, $routes);