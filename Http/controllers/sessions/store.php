<?php 

use Core\Authenticator;
use Core\ValidationException;
use Http\Forms\LoginForm;
use Core\Session;

try {
    $form = LoginForm::validate($attributes = [
        'email' => $_POST['email'],
        'password' => $_POST['password']
    ]);
} catch (ValidationException $exception) {
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->oldData);
    return redirect('/login');
}


if((new Authenticator)->attempt($attributes['email'], $attributes['password'])){
    redirect('/');
}

$form->setErrors('email', 'No matching email address or password found.');


