<?php

// require basePath('Validator.php');

$currentUser = 1;
$errors = [];

$config = require basePath('config.php');
$db = new Database($config['database']);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    

    if (! Validator::bodyText($_POST['body'], 1, 1000)) {
        $errors['body'] = 'A body of no more than 1,000 characters is required...';
    } 


    if (empty($errors)) {
        $db->query('INSERT INTO notes(body, user_id) VALUES (:body, :user_id)', [
            'body' => $_POST['body'],
            'user_id' => $currentUser,
        ]);
        $errors['body'] = 'Submitted Succesfully';
    } 
}

view("notes/create.view.php", [
    'heading' => 'Create Notes',
    'errors' => $errors
]);