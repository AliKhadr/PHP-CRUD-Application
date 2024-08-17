<?php

view("index.view.php", [
    'heading' => isset($_SESSION['user']) ? "Hello, {$_SESSION['user']['name']}" : 'Home'
]);
