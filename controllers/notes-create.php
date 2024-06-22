<?php

$heading = "Create Notes";
$currentUser = 1;

$config = require 'config.php';
$db = new Database($config['database']);

// dd($_SERVER);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // dd($_POST);
    $db->query('INSERT INTO notes(body, user_id) VALUES (:body, :user_id)', [
        'body' => $_POST['body'],
        'user_id' => $currentUser
    ]);
}

require "views/notes-create.view.php";
