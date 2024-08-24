<?php

namespace Core;

class Authenticator{

    public function attempt($email, $password){

        $user = App::resolve(Database::class)->query('SELECT * FROM users WHERE email = :email', [
            'email' => $email
        ])->find();

        if($user){
            if(password_verify($password, $user['password'])){
                $this->login([
                    'email' => $email,
                    'name' => $user['name'],
                    'userId' => $user['id']
                ]);
                return true;
            }
        }

        return false;
    }

    public function login($user){
        $_SESSION['user'] = $user;
    
        session_regenerate_id(true);
    }
    
    public function logout(){
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

}