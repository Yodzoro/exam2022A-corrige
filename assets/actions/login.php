<?php

require_once __DIR__ . '/../db/Database.php';

$db = new Database();
$result = $db->login(
    $_POST['username'],
    $_POST['password'],
);

if ($result) {
    session_start();
    $_SESSION['username'] = $_POST['username'];

    if (isset($_GET['target'])) {
        header('Location: ' . base64_decode($_GET['target']));
    } else {
        header('Location: /index.php');
    }
} else {
    header('Location: /login.php?error=1');
}
