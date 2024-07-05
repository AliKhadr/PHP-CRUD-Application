<?php

$heading = "Note";
$currentUser = 1;

$config = require 'config.php';
$db = new Database($config['database']); 


// if (! $_GET){
//     abort(404);
// }


$note = $db->query('select * from notes where id = :id', ['id'=> $_GET['id']])->findOrFail();

authorize($note['user_id'] == $currentUser);

require "views/notes/show.view.php";
