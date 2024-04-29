<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$currentUserId = 3;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $note = $db->query('SELECT * FROM notes WHERE user_id = :user AND id = :id', [
        'user' => 3,
        'id' => $_GET['id']
    ])->findOrFail();

    authorize($note['user_id'] === $currentUserId);

    $db->query("DELETE FROM notes WHERE id = :id", [
        ':id' => $_GET['id']
    ]);

    header('Location: /notes');
    exit();

} else {

    $note = $db->query('SELECT * FROM notes WHERE user_id = :user AND id = :id', [
        'user' => 3,
        'id' => $_GET['id']
    ])->findOrFail();

    authorize($note['user_id'] === $currentUserId);

    view('notes/show.view.php', [
        'heading' => 'Note',
        'note' => $note
    ]);
}

