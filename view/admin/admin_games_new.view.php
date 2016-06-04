<h1>
    New Game
</h1>

<form action="<?php echo url(url_for('admin_games_create_entity')); ?>" method="post">
    <p>
        <label for="home_team_id">Хозяева</label>
        <select name="home_team_id" id="home_team_id">
            <option>
            </option>
            <?php foreach (\Team::query()->all() as $team): ?>
                <option value="<?php echo $team->id; ?>" <?php if(isset($old['home_team_id']) && $team->id == $old['home_team_id']) echo "selected" ?> >
                    <?php echo $team->name; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="home_scores">Голы</label>
        <input type="text" name="home_scores" id="home_scores"></input>

        <?php if (isset($errors['home_team_id'])): ?>
            <span class="help-block"><?php echo $errors['home_team_id'] ?></span>
        <?php endif ?>
    </p>

    <p>
        <label for="guest_team_id">Гости</label>
        <select name="guest_team_id" id="guest_team_id">
            <option>
            </option>
            <?php foreach (\Team::query()->all() as $team): ?>
                <option value="<?php echo $team->id; ?>" <?php if(isset($old['guest_team_id']) && $team->id == $old['guest_team_id']) echo "selected" ?> >
                    <?php echo $team->name; ?>
                </option>
            <?php endforeach; ?>
        </select>


        <label for="guest_scores">Голы</label>
        <input type="text" name="guest_scores" id="guest_scores"></input>

        <?php if (isset($errors['guest_team_id'])): ?>
            <span class="help-block"><?php echo $errors['guest_team_id'] ?></span>
        <?php endif ?>
    </p>

    <p>
        <label for="date">Дата</label>
        <input type="text" name="date" id="date"></input>
    </p>

        <?php if (isset($errors['date'])): ?>
            <span class="help-block"><?php echo $errors['date'] ?></span>
        <?php endif ?>

    <p>
        <button type="submit" class="btn btn-default">Создать игру</button>
        <button type="submit" name="page" value="<?php echo url(url_for('admin_games')) ?>" class="btn btn-default">Изменить название</button>
    </p>
</form>