<?php

require_once __DIR__ . '/../db/Database.php';

$db = new Database();
$db->register(
    $_POST['username'],
    $_POST['password'],
);

header('Location: /login.php');
