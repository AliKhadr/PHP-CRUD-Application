<?php

$_SESSION['name'] = 'Ali';

view("index.view.php", [
    'heading' => 'Home'
]);
