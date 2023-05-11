<?php
if (!isset($_GET['id'])) {
  header('Location: /');
  exit;
}

require_once __DIR__ . '/assets/locale/Translate.php';
$translate = new Translate('fr');

$specificCSS = '
<link rel="stylesheet" href="assets/css/index.css"/>
';

require_once __DIR__ . '/assets/template/head.php';


require_once __DIR__ . '/assets/db/Database.php';

$db = new Database();
$game = $db->getGame($_GET['id']);
?>

<header style="background-image: url('/public/uploads/<?= $game['image'] ?>')">
  <h1><?= $game['name'] ?></h1>
</header>

<?php require_once __DIR__ . '/assets/template/nav.php' ?>

<main>
  <p>
    <?= $game['description'] ?>
  </p>
</main>

<?php
require_once __DIR__ . '/assets/template/footer.php';
?>
