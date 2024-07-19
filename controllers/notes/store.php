<?php

// require basePath('Validator.php');
use Core\Database;
use Core\Validator;

$currentUser = 1;
$errors = [];

$config = require basePath('config.php');
$db = new Database($config['database']);

if (! Validator::bodyText($_POST['body'], 1, 1000)) {
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
$errors['body'] = 'Submitted Succesfully';
// header('location: /notes');
// die();


view("notes/create.view.php", [
    'heading' => 'Create Notes',
    'errors' => $errors
]);