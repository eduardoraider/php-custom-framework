<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$currentUserId = 3;

$note = $db->query('SELECT * FROM notes WHERE user_id = :user AND id = :id', [
    'user' => 3,
    'id' => $_POST['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

$errors = [];

if(!Validator::string($_POST['note'], 1, 25)) {
    $errors['note'] = 'A note of no more than 25 characters is required.';
}

if(count($errors)) {
    return view('notes/edit.view.php', [
        'heading' => 'edit Note',
        'note' => $note,
        'errors' => $errors
    ]);
}

$db->query('UPDATE notes SET body = :body WHERE id = :id', [
    'id' => $_POST['id'],
    'body' => $_POST['note']
]);

header('Location: /notes');
exit();