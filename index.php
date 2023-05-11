<?php
require_once __DIR__ . '/assets/locale/Translate.php';
$translate = new Translate('fr');

$specificCSS = '
<link rel="stylesheet" href="assets/css/index.css"/>
';

$specificJS = '
<script src="assets/js/loadGame.js" type="module" defer></script>
';

require_once __DIR__ . '/assets/template/head.php';
?>

<header>
  <h1><?= $translate->getTrad('home.title') ?></h1>
</header>

<?php require_once __DIR__ . '/assets/template/nav.php' ?>

<main>
  <h2><?= $translate->getTrad('home.subtitle') ?></h2>

  <section></section>

  <button>
    <?= $translate->getTrad('home.loadMore') ?>
  </button>
</main>

<?php
require_once __DIR__ . '/assets/template/footer.php';
?>
