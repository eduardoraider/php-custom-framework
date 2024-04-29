<?php

use Core\Database;
use Core\Validator;

$config = require base_path('config.php');
$db = new Database($config['database']);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(!Validator::string($_POST['note'], 1, 25)) {
        $errors['note'] = 'A note of no more than 25 characters is required.';
    }

    if(empty($errors)) {
        $db->query('INSERT INTO notes (body, user_id) VALUES (:body, :user_id)', [
            ':body' => $_POST['note'],
            ':user_id' => 3
        ]);
    }

    header('Location: /notes');
    exit();

}

view('notes/create.view.php', [
    'heading' => 'Create Note',
    'errors' => $errors
]);