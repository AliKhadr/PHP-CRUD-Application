<?php

namespace Http\Forms;
use Core\Validator;

class LoginForm {

    protected $errors = [];

    public function validate($email, $password){
        // Validate email input
        if( ! Validator::emailValid($email)){
            $this->errors['email'] = 'Please provide a valid email address.';
        }

        // Validate password input
        if( ! Validator::strLength($password, 7)){
            $this->errors['password'] = 'Please provide a valid password.';
        }
        return empty($this->errors);
    }

    public function getErrors(){
        return $this->errors;
    }

}