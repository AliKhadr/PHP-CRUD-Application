<?php 

use Core\Authenticator;
use Http\Forms\LoginForm;
use Core\Session;

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();
if($form->validate($email, $password)){
    if((new Authenticator)->attempt($email, $password)){
        redirect('/');
    } else{
        $form->setErrors('email', 'No matching email address or password found.');
    }
}

Session::flash('errors', $form->getErrors());
return redirect('/login');
