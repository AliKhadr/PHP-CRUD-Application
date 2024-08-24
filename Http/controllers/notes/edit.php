<?php

use Core\App;
use Core\Database;

$currentUser = $_SESSION['user']['userId'];

$db = App::resolve('Core\Database');

$note = $db->query('select * from notes where id = :id', ['id'=> $_GET['id']])->findOrFail();

authorize($note['user_id'] == $currentUser);

view("notes/edit.view.php", [
    'heading' => 'Edit Notes',
    'errors' => [],
    'note' => $note
]);