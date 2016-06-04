<h1>Новый матч</h1>

<form action="<?php echo url(url_for('admin_games_create_entity')); ?>" method="post">
    <div class="form-group">
        <label for="home_team_id">Хозяева</label>
        <select class="form-control" name="home_team_id" id="home_team_id">
            <option></option>
            <?php foreach ($teams as $team): ?>
                <option value="<?php echo $team->id; ?>" <?php if(isset($old['home_team_id']) && $team->id == $old['home_team_id']) echo "selected" ?> >
                    <?php echo $team->name; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($errors['home_team_id'])): ?>
            <span class="help-block"><?php echo $errors['home_team_id'] ?></span>
        <?php endif ?>
    </div>
    
    <div class="form-group">
        <label for="home_scores">Голы</label>
        <input class="form-control" type="text" name="home_scores" id="home_scores"></input>
    </div>

    <div class="form-group">
        <label for="guest_team_id">Гости</label>
        <select class="form-control" name="guest_team_id" id="guest_team_id">
            <option></option>
            <?php foreach ($teams as $team): ?>
                <option value="<?php echo $team->id; ?>" <?php if(isset($old['guest_team_id']) && $team->id == $old['guest_team_id']) echo "selected" ?> >
                    <?php echo $team->name; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($errors['guest_team_id'])): ?>
            <span class="help-block"><?php echo $errors['guest_team_id'] ?></span>
        <?php endif ?>
    </div>

    <div class="form-group">
        <label for="guest_scores">Голы</label>
        <input class="form-control" type="text" name="guest_scores" id="guest_scores"></input>
    </div>

    <div class="form-group">
        <label for="date">Дата</label>
        <input class="form-control" type="text" name="date" id="date"></input>
        <?php if (isset($errors['date'])): ?>
            <span class="help-block"><?php echo $errors['date'] ?></span>
        <?php endif ?>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Сохранить и создать ещё</button>
        <button type="submit" name="page" value="<?php echo url(url_for('admin_games')) ?>" class="btn btn-primary">Сохранить</button>
    </div>
</form>