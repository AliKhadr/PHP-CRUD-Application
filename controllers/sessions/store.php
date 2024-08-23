<?php 

use Core\Validator;
use Core\App;
use Core\Database;

$errors = [];
$email = $_POST['email'];
$password = $_POST['password'];
$db = App::resolve('Core\Database');

// Validate email input
if( ! Validator::emailValid($email)){
    $errors['email'] = 'Please provide a valid email address.';
}

// Validate password input
if( ! Validator::strLength($password)){
    $errors['password'] = 'Please provide a valid password.';
}

if (! empty($errors)){
    return view("sessions/create.view.php", [
        'errors' => $errors
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
            'name' => $user['name']
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







