<?php

$heading = "Note";

$config = require 'config.php';
$db = new Database($config['database']); 

$notes = $db->query('select * from notes where id = :id', ['id'=> $_GET['id']])->fetchAll();



require "views/notes.view.php";
