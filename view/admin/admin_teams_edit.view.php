<h1>
    Edit team <?php echo $team->name; ?>
</h1>

<form action="<?php echo url(url_for('admin_teams_edit_entity'))."?club_id=".$team->id; ?>" method="post">
    <div class="form-group <?php if (isset($errors['name'])) echo 'has-error' ?>">
        <label for="change_club_name">Изменить название</label>
        <input type="text" class="form-control" name="name" id="change_club_name" value="<?php echo $team->name; ?>">
        <?php if (isset($errors['name'])): ?>
            <span class="help-block"><?php echo $errors['name'] ?></span>
        <?php endif ?>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-default">Изменить название и продолжить</button>
        <button type="submit" name="page" value="<?php echo url(url_for('admin_teams')) ?>" class="btn btn-default">Изменить название</button>
    </div>
</form>

<h2>
    Players
</h2>

<a href="<?php echo url(url_for('admin_players_new')); ?>"><button class="btn btn-default">New Player</button></a>

<table>
    <?php foreach($team->players()->all() as $player): ?>
        <tr>
            <td>
                <?php echo $player->name; ?>
            </td>
            <td>
                <a href="<?php echo url(url_for('admin_players_edit')); ?>?player_id=<?php echo $player->id ?>">
                    Edit
                </a>
            </td>
            <td>
                Delete
            </td>
        </tr>
    <?php endforeach; ?>
</table>