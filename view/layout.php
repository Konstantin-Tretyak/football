<!doctype html>
<html>
    <head>
        <title>
            Football
        </title>
        <meta charset="utf-8">

        <link rel="stylesheet" href="<?php echo url('css/bootstrap.css'); ?>">
        <link rel="stylesheet" href="<?php echo url('css/css.css'); ?>">
    </head>
    <body>
        <header>
            <form method="post" action="<?php echo url_for('login'); ?>">
                <?php if ($authorized_user): ?>
                    Hello юзер <?php echo $authorized_user['login']; ?> ! <br/>

                    <button class="btn btn-default" type="submit" name="logout">Выйти</button>

                <?php else: ?>
                        Hello, гость!
                        <div class="form-group <?php if (isset($errors['login'])) echo 'has-error' ?>">
                            <input type="text" class="form-control" name="login" id="change_club_name" placeholder="Логин"
                                   value="<?php if(isset($old_autorize['login'])) echo $old_autorize['login']; ?>">
                        </div>

                        <div class="form-group <?php if (isset($errors['password'])) echo 'has-error' ?>">
                            <input type="password" class="form-control" name="password" id="change_club_name" placeholder="Пароль"
                                   value="<?php if(isset($old_autorize['password'])) echo $old_autorize['password']; ?>">
                        </div>

                        <button class="btn btn-default" type="submit">Войти</button>
                        <?php if (isset($errors['login'])): ?>
                            <span class="help-block"><?php echo $errors['login'] ?></span>
                        <?php endif ?>

                        <?php if (isset($errors['password'])): ?>
                            <span class="help-block"><?php echo $errors['password'] ?></span>
                        <?php endif ?>
                <?php endif; ?>
            </form>
        </header>

        <?php
            include($path);
        ?>



    </body>
</html>

