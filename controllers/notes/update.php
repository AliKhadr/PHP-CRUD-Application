<?php
// require basePath('Validator.php');
use Core\App;
use Core\Database;
use Core\Validator;

$currentUser = $_SESSION['user']['userId'];
$errors = [];

$db = App::resolve('Core\Database');

$note = $db->query('select * from notes where id = :id', ['id'=> $_POST['id']])->findOrFail();

authorize($note['user_id'] == $currentUser);

if (! Validator::strLength($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1,000 characters is required...';
} 

if (! empty($errors)){
    return view("notes/edit.view.php", [
        'heading' => 'Edit Notes',
        'errors' => $errors,
        'note' => $note
    ]);
}

$db->query('UPDATE notes SET body = :body WHERE id = :id', [
    'body' => $_POST['body'],
    'id' => $_POST['id'],
]);

$errors['body'] = 'Edited Succesfully';

view("notes/edit.view.php", [
    'heading' => 'Edit Notes',
    'errors' => $errors,
    'note' => $note
]);