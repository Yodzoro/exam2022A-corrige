<?php
require_once __DIR__ . '/assets/locale/Translate.php';
$translate = new Translate('fr');

$specificJS = '
    <script src="/assets/js/random.js" defer type="module"></script>
    <script src="/assets/js/bubbles.js" defer type="module"></script>
';
$specificCSS = '
    <link rel="stylesheet" href="/assets/css/formPages.css"/>
';

require_once __DIR__ . '/assets/template/head.php';
if (!$userConnected) {
  header('Location: /login.php?target=' . base64_encode($_SERVER['REQUEST_URI']));
}

require_once __DIR__ . '/assets/template/nav.php';
?>

<main>
  <div>
    <h1><?php echo $translate->getTrad('admin.title'); ?></h1>

    <form action="/assets/actions/admin.php" method="post" enctype="multipart/form-data">
      <label>
        <?php echo $translate->getTrad('admin.picture'); ?>
        <input type="file" name="picture" required/>
      </label>

      <label>
        <?php echo $translate->getTrad('admin.name'); ?>
        <input type="text" name="name" required/>
      </label>

      <label>
        <?php echo $translate->getTrad('admin.description'); ?>
        <textarea name="description" required></textarea>
      </label>

      <label>
        <?php echo $translate->getTrad('admin.price'); ?>
        <input type="number" step="0.01" name="price" required/>
      </label>

      <label>
        <?php echo $translate->getTrad('admin.releaseDate'); ?>
        <input type="date" name="releaseDate" required/>
      </label>

      <button type="submit">
        <?php echo $translate->getTrad('admin.add'); ?>
      </button>
    </form>
  </div>
</main>

<?php
require_once __DIR__ . '/assets/template/footer.php';
?>
