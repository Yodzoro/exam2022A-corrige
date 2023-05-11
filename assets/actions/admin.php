<?php

require_once __DIR__ . '/../db/Database.php';

$db = new Database();
$result = $db->insertGame(
    $_POST['name'],
    $_FILES['picture'],
    $_POST['description'],
    $_POST['price'],
    $_POST['releaseDate'],
);

if ($result) {
    header('Location: /index.php');
} else {
    header('Location: /admin.php?error=1');
}
