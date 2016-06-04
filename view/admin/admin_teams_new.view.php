<h1>Новая команда</h1>

<form action="<?php echo url(url_for('admin_teams_create_entity')); ?>" method="post">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="team">
        <?php if (isset($errors['name'])): ?>
            <span class="help-block"><?php echo $errors['name'] ?></span>
        <?php endif ?>
    </div>

    <!-- TODO -->
    
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Сохранить и создать ещё</button>
        <button type="submit" name="page" value="<?php echo url(url_for('admin_teams')) ?>" class="btn btn-primary">Сохранить</button>
    </div>
</form>