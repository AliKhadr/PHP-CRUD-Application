<?php

require 'Validator.php';

$heading = "Create Notes";
$currentUser = 1;

$config = require 'config.php';
$db = new Database($config['database']);

// dd($_SERVER);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

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

require "views/notes-create.view.php";
