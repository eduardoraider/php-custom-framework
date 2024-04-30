<?php

use Core\Validator;
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$errors = [];

if(!Validator::string($_POST['note'], 1, 25)) {
    $errors['note'] = 'A note of no more than 25 characters is required.';
}

if(count($errors)) {
    return view('notes/create.view.php', [
        'heading' => 'Create Note',
        'errors' => $errors
    ]);
}

$db->query('INSERT INTO notes (body, user_id) VALUES (:body, :user_id)', [
    ':body' => $_POST['note'],
    ':user_id' => 3
]);

header('Location: /notes');
exit();