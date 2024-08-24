<?php

use Core\App;
use Core\Database;

$currentUser = $_SESSION['user']['userId'];
$db = App::resolve('Core\Database');

$notes = $db->query('select * from notes where user_id = :user_id', [
    'user_id' => $currentUser
])->findAll();

view("notes/index.view.php", [
    'heading' => 'My Notes',
    'notes' => $notes
]);