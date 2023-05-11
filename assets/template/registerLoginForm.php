<main>
    <div>
        <h2><?= $title ?></h2>

        <form action="<?= $action ?>" method="post">
            <label>
                <?= $translate->getTrad('login.username') ?>*
                <input type="text" name="username" required>
            </label>

            <label>
                <?= $translate->getTrad('login.password') ?>*
                <input type="password" name="password" required>
            </label>

            <button type="submit"><?= $button ?></button>
        </form>
    </div>
</main>