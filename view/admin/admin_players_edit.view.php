<h1>
    Edit player <?php echo $player['name']; ?>
</h1>

<form action="" method="post">
    <div class="form-group">
        <label for="name">Изменить имя</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="<?php echo $player['name']; ?>">
    </div>
    
    <div class="form-group">
        <label for="position">Изменить позицию</label>
        <input type="text" class="form-control" name="position" id="position" placeholder="<?php echo $player['position']; ?>">
    </div>

    <div class="form-group">
        <select name="team_id">
            <option>
                Выберите клуб
            </option>
            <?php foreach ($teams as $team): ?>
                <option value="<?php echo $team['id']; ?>" <?php if( $team['id'] == $player['team_id']) {echo "selected=".$team['name'].'"';} ?>>
                    <?php echo $team['name']; ?>
                </option>
            <?php endforeach; ?>
        <select>
    </div>
    <button type="submit" class="btn btn-default">Изменить игрока</button> 
</form>


