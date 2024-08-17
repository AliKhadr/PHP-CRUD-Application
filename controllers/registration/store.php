<?php
use Core\Validator;
use Core\App;
use Core\Database;

$errors = [];
$email = $_POST['email'];
$password = $_POST['password'];
$name = $_POST['name'];

// Validate email input
if( ! Validator::emailValid($email)){
    $errors['email'] = 'Please provide a valid email address.';
}

// Validate password input
if( ! Validator::strLength($password, 7, 255)){
    $errors['password'] = 'Please provide a valid password of length 7 or more.';
}

// Validate name input
if( ! $name){
    $errors['name'] = 'Please provide a name.';
}

if (! empty($errors)){
    return view("registration/create.view.php", [
        'errors' => $errors
    ]);
}

$db = App::resolve('Core\Database');
$user = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $email
])->find();

// If email already exists
if($user){
    // Redirect to login page
    // ------ use this instead ------ header('location: /');
    $errors['email'] = 'Email already exists.';
    return view("registration/create.view.php", [
        'errors' => $errors
    ]);
}else{
    $db->query('INSERT INTO users(name, email, password) VALUES (:name, :email, :password)', [
        'name' => $name,
        'email' => $email,
        'password' => $password
    ]);

    $_SESSION['user'] = [
        'email' => $email,
        'name' => $name
    ];

    header('location: /');
    // After redirect, kill script
    exit();
}
