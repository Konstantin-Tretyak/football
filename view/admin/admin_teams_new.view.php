<h1>
    New Team
</h1>

<form action="" method="post">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="team">

        <?php if (isset($errors['name'])): ?>
            <span class="help-block"><?php echo $errors['name'] ?></span>
        <?php endif ?>

        <button type="submit" class="btn btn-default">СОЗДАТЬ</button>
        <button type="submit" name="page" value="index.php" class="btn btn-default">Изменить название и продолжить</button>
    </div>
</form>

<h2>
    Players
</h2>

<a href="<?php echo url(url_for('admin_players_new')); ?>"><button class="btn btn-default">New Player</button></a>
