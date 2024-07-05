<?php

$config = require basePath('config.php');
$db = new Database($config['database']); 

$notes = $db->query('select * from notes where user_id = 1')->findAll();

view("notes/index.view.php", [
    'heading' => 'My Notes',
    'notes' => $notes
]);
