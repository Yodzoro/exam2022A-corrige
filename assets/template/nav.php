<nav>
  <ul>
    <li>
      <a href="/">
        <i class="mdi mdi-home"></i>
        <?= $translate->getTrad('core.nav.home') ?>
      </a>
    </li>
    <?php if (!$userConnected) : ?>
      <li>
        <a href="/login.php">
          <i class="mdi mdi-account"></i>
          <?= $translate->getTrad('core.nav.login') ?>
        </a>
      </li>
      <li>
        <a href="/register.php">
          <i class="mdi mdi-account-plus"></i>
          <?= $translate->getTrad('core.nav.register') ?>
        </a>
      </li>
    <?php else : ?>
      <li>
        <a href="/admin.php">
          <i class="mdi mdi-security"></i>
          <?= $translate->getTrad('core.nav.admin') ?>
        </a>
      </li>
      <li>
        <a href="/logout.php">
          <i class="mdi mdi-account-off"></i>
          <?= $translate->getTrad('core.nav.logout') ?>
        </a>
      </li>
    <?php
    endif;
    ?>
  </ul>
</nav>
