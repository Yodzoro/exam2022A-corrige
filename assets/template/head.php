<?php
session_start();
$userConnected = false;

if (isset($_SESSION['username'])) {
    $userConnected = true;
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/assets/img/favicon.svg" type="image/x-icon">
    <title>Jeux Vidéos</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap&family=Roboto" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@6.9.96/css/materialdesignicons.min.css"/>
    <link rel="stylesheet" href="/assets/css/style.css"/>

    <?= $specificCSS ?? '' ?>
    <?= $specificJS ?? '' ?>
</head>
<body>