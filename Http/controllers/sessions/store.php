<?php 

use Core\Authenticator;
use Core\Validator;
use Http\Forms\LoginForm;

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

return view("sessions/create.view.php", [
    'errors' => $form->getErrors()
]);








