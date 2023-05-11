<?php

require_once __DIR__ . '/../db/Database.php';
$db = new Database();

echo json_encode($db->getGameTableSize());
