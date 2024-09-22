<?php 

use Core\Authenticator;
use Http\Forms\LoginForm;
use Core\Session;

$form = LoginForm::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);

if((new Authenticator)->attempt($attributes['email'], $attributes['password'])){
    redirect('/');
}

$form->setErrors('email', 'No matching email address or password found.');

Session::flash('errors', $form->getErrors());
Session::flash('old', ['email' => $email]);
return redirect('/login');
