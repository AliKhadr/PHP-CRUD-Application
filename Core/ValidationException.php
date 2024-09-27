<?php

namespace Core;

Class ValidationException extends \Exception{

    public readonly array $errors;
    public readonly array $oldData;

    public static function throw($errors, $oldData){
        $instance = new static;
        $instance->errors = $errors;
        $instance->oldData = $oldData;

        throw $instance;
    }

}