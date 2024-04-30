<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = 3;

$note = $db->query('SELECT * FROM notes WHERE user_id = :user AND id = :id', [
    'user' => 3,
    'id' => $_POST['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

$db->query("DELETE FROM notes WHERE id = :id", [
    ':id' => $_POST['id']
]);

header('Location: /notes');
exit();
