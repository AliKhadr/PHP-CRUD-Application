<?php

use Core\App;
use Core\Database;

$currentUser = $_SESSION['user']['userId'];

$db = App::resolve('Core\Database');

!isset($_GET['id']) ? abort(404) : null;
$note = $db->query('select * from notes where id = :id', ['id'=> $_GET['id']])->findOrFail();

authorize($note['user_id'] == $currentUser);

view("notes/show.view.php", [
    'heading' => 'Note',
    'note' => $note
]);


