<?php

$heading = "Create Notes";
$currentUser = 1;

$config = require 'config.php';
$db = new Database($config['database']);

// dd($_SERVER);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

    if (strlen($_POST['body']) === 0) {
        $errors['body'] = 'No body text found...';
    } 

    if (strlen($_POST['body']) > 1000) {
        $errors['body'] = 'The body can not be more than 1,000 characters';
    }

    if (empty($errors)) {
        $db->query('INSERT INTO notes(body, user_id) VALUES (:body, :user_id)', [
            'body' => $_POST['body'],
            'user_id' => $currentUser
        ]);
    } 
}

require "views/notes-create.view.php";
