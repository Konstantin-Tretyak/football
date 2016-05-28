<h1>
    New player
</h1>

<form action="<?php echo url(url_for('admin_players_create_entity')); ?>" method="post">
    <div class="form-group">
        <label for="player_name">Имя</label>
        <input type="text" class="form-control" name="player_name" id="player_name" placeholder="Введите имя" value="<?php if(isset($old['player_name'])) echo $old['player_name']; ?>">

        <?php if (isset($errors['player_name'])): ?>
            <span class="help-block"><?php echo $errors['player_name'] ?></span>
        <?php endif ?>

        <label for="player_position">Позиция</label>
        <input type="text" class="form-control" name="player_position" id="player_position" placeholder="Введите позицию">
        <p>Выберите клуб</p>
        
        <select name="players_team_id">
            <option>
            </option>
            <?php foreach ($teams as $team): ?>
                <option value="<?php echo $team['id']; ?>"<?php if(isset($old['players_team_id']) && $team['id'] == $old['players_team_id']) echo "selected" ?>>
                    <?php echo $team['name']; ?>
                </option>
            <?php endforeach; ?>
        <select>

        <?php if (isset($errors['players_team_id'])): ?>
            <span class="help-block"><?php echo $errors['players_team_id'] ?></span>
        <?php endif ?>

        <p>
            <button type="submit" class="btn btn-default">
                Создать игрока
            </button>
        </p>
    </div>
</form>