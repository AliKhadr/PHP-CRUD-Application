<?php

// require basePath('Validator.php');
use Core\App;
use Core\Database;
use Core\Validator;

$currentUser = $_SESSION['user']['userId'];
$errors = [];

$db = App::resolve('Core\Database');

if (! Validator::strLength($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1,000 characters is required...';
} 

if (! empty($errors)){
    return view("notes/create.view.php", [
        'heading' => 'Create Notes',
        'errors' => $errors
    ]);
}

$db->query('INSERT INTO notes(body, user_id) VALUES (:body, :user_id)', [
    'body' => $_POST['body'],
    'user_id' => $currentUser,
]);

// $errors['body'] = 'Submitted Succesfully';
header('location: /notes');
die();


// view("notes/create.view.php", [
//     'heading' => 'Create Notes',
//     'errors' => $errors
// ]);