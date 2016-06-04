<h1>
    Edit player <?php echo $player->name; ?>
</h1>

<?php ///TODO: взятие GET части УРЛА!?>
<form action="<?php echo url(url_for('admin_players_edit_entity'))."?player_id=".$player->id; ?>" method="post">
    <div class="form-group">
        <label for="name">Изменить имя</label>
        <input type="text" class="form-control" name="name" id="name" value="<?php echo $player->name; ?>">
    </div>
    
    <div class="form-group">
        <label for="position">Изменить позицию</label>
        <input type="text" class="form-control" name="position" id="position" value="<?php echo $player->position; ?>">
    </div>

    <div class="form-group">
        <select name="team_id">
            <option>
                Выберите клуб
            </option>
            <?php foreach (\Team::query()->all() as $team): ?>
                <option value="<?php echo $team->id; ?>" <?php if( $team->id == $player->team_id) {echo "selected=".$team->name.'"';} ?>>
                    <?php echo $team->name; ?>
                </option>
            <?php endforeach; ?>
        <select>
    </div>
    <button type="submit" class="btn btn-default">Изменить игрока</button> 
</form>


