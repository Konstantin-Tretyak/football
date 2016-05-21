<!doctype html>
<html>
    <head>
        <title>
            Football
        </title>
        <meta charset="utf-8">

        <link rel="stylesheet" href="<?php echo url('/css/bootstrap.css'); ?>">
        <link rel="stylesheet" href="<?php echo url('/css/css.css'); ?>">
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
    </body>
</html>
