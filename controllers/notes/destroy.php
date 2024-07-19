<?php

use Core\Database;

$currentUser = 1;

$config = require basePath('config.php');
$db = new Database($config['database']); 

$note = $db->query('select * from notes where id = :id', ['id'=> $_POST['id']])->findOrFail();

authorize($note['user_id'] == $currentUser);

$db->query('DELETE FROM notes WHERE id = :id', [
    'id'=> $_POST['id']
]);

header('location: /notes');
exit();



