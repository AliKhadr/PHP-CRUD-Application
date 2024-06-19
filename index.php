<?php

require 'functions.php';
require 'Database.php';

$config = require 'config.php';

$id = $_GET['id'];
// dd($id);

$dbo = new Database($config['database']);

$query = "select * from blogs where id = ?";
$blogs = $dbo->query($query, [$id])->fetch();

// $query = "select * from blogs where id = :id";
// $blogs = $dbo->query($query, [':id' => $id])->fetch();

echo "<li>" . $blogs['Title'] . "</li>";

// foreach ($blogs as $blog) { 
//     echo "<li>" . $blog['Title'] . "</li>";
// }

require 'router.php';





