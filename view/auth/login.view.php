<form method="post" action="<?php echo url_for('login'); ?>">
    <div class="form-group <?php if (isset($errors['login'])) echo 'has-error' ?>">
        <input type="text" class="form-control" name="login" id="change_club_name" placeholder="Логин"
               value="<?php if(isset($old['login'])) echo $old['login']; ?>">
        <?php if (isset($errors['login'])): ?>
            <span class="help-block"><?php echo $errors['login'] ?></span>
        <?php endif ?>
    </div>

    <div class="form-group <?php if (isset($errors['password'])) echo 'has-error' ?>">
        <!-- do not display old password for security reeasons -->
        <input type="password" class="form-control" name="password" id="change_club_name" placeholder="Пароль"
               value="">
        <?php if (isset($errors['password'])): ?>
            <span class="help-block"><?php echo $errors['password'] ?></span>
        <?php endif ?>
    </div>

    <button class="btn btn-default" type="submit">Войти</button>
    <button class="btn btn-default" type="submit" name="action" value="register">Зарегистрироваться</button>
</form>