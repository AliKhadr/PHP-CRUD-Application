<?php 

use Core\Authenticator;
use Core\Validator;
use Http\Forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();
if( !($form->validate($email, $password))){
    return view("sessions/create.view.php", [
        'errors' => $form->getErrors()
    ]);
}

$auth = new Authenticator();
if($auth->attempt($email, $password)){
    redirect('/');
}

return view("sessions/create.view.php", [
    'errors' => [
        'email' => 'No matching email address or password found.'
    ]
]);













