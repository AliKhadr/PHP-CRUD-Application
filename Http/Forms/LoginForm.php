<?php

namespace Http\Forms;
use Core\ValidationException;
use Core\Validator;

class LoginForm {

    protected $errors = [];

    public function __construct(public array $attributes){
        // Validate email input
        if( ! Validator::emailValid($attributes['email'])){
            $this->errors['email'] = 'Please provide a valid email address.';
        }

        // Validate password input
        if( ! Validator::strLength($attributes['password'], 7)){
            $this->errors['password'] = 'Please provide a valid password.';
        }
    }

    public static function validate($attributes){
        $instance = new static($attributes);
        if($instance->hasErrors()){
            // throw new ValidationException();
            ValidationException::throw($instance->getErrors(), $instance->attributes);
        }

        return $instance;
    }

    public function hasErrors(){
        return count($this->errors);
    }

    public function getErrors(){
        return $this->errors;
    }

    public function setErrors($field, $message){
        $this->errors[$field] = $message;
    }

}