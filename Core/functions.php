<?php

use Core\Response;

function dd($value){
    echo '<pre>';
    var_dump( $value );
    echo '</pre>';
    die();
}

function urlIs($url){
    return $_SERVER['REQUEST_URI'] === $url;
}

function abort($status = 404){
    http_response_code($status);
    require basePath("views/{$status}.php");
    die();
}

function authorize($condition, $status = Response::FORBIDDEN) {
    if(! $condition){
        abort($status);
    }
}

// Helper function for base path of required files
function basePath($path) {
    return BASE_PATH . $path;
}

function view($path, $attributes = []) {
    extract($attributes);
    require basePath('views/'. $path);
}

function login($user){
    $_SESSION['user'] = $user;

    session_regenerate_id(true);
}

function logout(){
    // Clear session data super global
    $_SESSION = [];

    // Delete session file
    session_destroy();

    /*
        Delete cookie stored in browser by setting value to empty
        Update cookie and set corresponding expiration

        Name of cookie: PHPSESSID (From Browser>Application>Storage)
        Value of cookie: empty string
        Expiry date: 1hr in the past
        Path of cookie: Use function session_get_cookie_params() to find path
        Domain of cookie: Use function session_get_cookie_params() to find domain
    */
    $cookieParams = session_get_cookie_params();
    setcookie('PHPSESSID', '', time() - 3600, $cookieParams['path'], $cookieParams['domain'], $cookieParams['secure'], $cookieParams['httponly']);
}