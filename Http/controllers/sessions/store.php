<?php 

use Core\Validator;
use Core\App;
use Core\Database;
use Http\Forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];
$db = App::resolve('Core\Database');

$form = new LoginForm();
if( !($form->validate($email, $password))){
    return view("sessions/create.view.php", [
        'errors' => $form->getErrors()
    ]);
}

//Log in user If credentials match
$user = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $email
])->find();

if($user){
    if(password_verify($password, $user['password'])){
        login([
            'email' => $email,
            'name' => $user['name'],
            'userId' => $user['id']
        ]);
        header('location: /');
        exit();
    }
}

return view("sessions/create.view.php", [
    'errors' => [
        'email' => 'No matching email address or password found.'
    ]
]);







