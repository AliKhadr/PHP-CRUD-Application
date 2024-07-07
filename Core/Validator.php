<?php

namespace Core;

class Validator {

    public static function bodyText($text, $min = 1, $max = INF) {

        $value = trim($text);

        return strlen($value) >= $min && strlen($value) <= $max;
    }


}