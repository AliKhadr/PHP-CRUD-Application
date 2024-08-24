<?php

namespace Core;

class Validator {

    public static function strLength($text, $min = 1, $max = INF) {
        $value = trim($text);
        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function emailValid($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

}