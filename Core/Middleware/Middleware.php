<?php

namespace Core\Middleware;

class Middleware {
    const MAP = [
        'guest' => Guest::class,
        'auth' => Auth::class
    ];

    public static function resolve($key){
        if(!$key){
            return;
        }
        $middleware = self::MAP[$key] ?? false;

        if(! $middleware){
            throw new \Exception("No matching middleware found for key: {$key}.");
        }

        (new $middleware)->handle();
    }
}