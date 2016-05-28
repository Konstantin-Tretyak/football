<!doctype html>
<html>
    <head>
        <title>
            Football
        </title>
        <meta charset="utf-8">

        <link rel="stylesheet" href="<?php echo url('/css/bootstrap.css'); ?>">
        <link rel="stylesheet" href="<?php echo url('/css/css.css'); ?>">
        <link rel="stylesheet" href="<?php echo url('/css/whirl.css'); ?>">
        <link rel="stylesheet" href="<?php echo url('/css/pnotify.custom.min.css'); ?>">
    </head>
    <body>
        <header>
            <?php if ($authorized_user): ?>
                Hello юзер <?php echo $authorized_user['login']; ?> ! <br/>
                <a href="<?php echo url(url_for('logout')) ?>">Logout</a>
            <?php else: ?>
                    Hello, гость!
                    <a href="<?php echo url(url_for('login')) ?>">Login</a>
            <?php endif; ?>
        </header>
        <?php
            include($path);
        ?>

        <script src="<?php echo url('/scripts/jquery-1.12.1.js'); ?>"></script>
        <script src="<?php echo url('/scripts/pnotify.custom.min.js'); ?>"></script>
        <script src="<?php echo url('/scripts/app.js'); ?>"></script>
        <script src="<?php echo url('/scripts/users_liked.js'); ?>"></script>
        <script src="<?php echo url('/scripts/comments.js'); ?>"></script>

    </body>
</html>
