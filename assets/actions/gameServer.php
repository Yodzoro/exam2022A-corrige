<?php

require_once __DIR__ . '/../db/Database.php';
$db = new Database();

$page = 0;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

echo json_encode($db->getGames($page * 3, 3));
