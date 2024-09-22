<?php

namespace Core;

class Session {
    public static function has($key){
        return (bool) self::get($key);
    }

    public static function put($key, $value){
        $_SESSION[$key] = $value;
    }

    // Checks if key has been flashed to session first, if not then check if key exists in top level.
    public static function get($key, $default = null){
        return $_SESSION['_flash'][$key] ?? $_SESSION[$key] ?? $default;
    }

    public static function flash($key, $value){
        $_SESSION['_flash'][$key] = $value;
    }

    public static function unflash(){
        unset($_SESSION['_flash']);
    }

    public static function flush()
    {
        $_SESSION = [];
    }

    public static function destroy()
    {
        self::flush();

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
}