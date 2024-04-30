<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = 3;

$note = $db->query('SELECT * FROM notes WHERE user_id = :user AND id = :id', [
    'user' => 3,
    'id' => $_GET['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

view('notes/edit.view.php', [
    'heading' => 'Edit Note',
    'note' => $note,
    'errors' => []
]);