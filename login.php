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
if ($userConnected) {
    header('Location: /index.php');
}

require_once __DIR__ . '/assets/template/nav.php';

$title = $translate->getTrad('login.title');
$action = '/assets/actions/login.php'. (isset($_GET['target']) ? '?target=' . $_GET['target'] : '');
$button = $translate->getTrad('login.submit');
require_once __DIR__ . '/assets/template/registerLoginForm.php';

require_once __DIR__ . '/assets/template/footer.php';
?>
