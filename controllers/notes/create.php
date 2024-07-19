<?php
$errors = [];

view("notes/create.view.php", [
    'heading' => 'Create Notes',
    'errors' => $errors
]);