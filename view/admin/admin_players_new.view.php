<h1>
    New player
</h1>

<form action="" method="post">
    <div class="form-group">
        <label for="player_name">Имя</label>
        <input type="text" class="form-control" name="player_name" id="player_name" placeholder="Введите имя">
        <label for="player_position">Позиция</label>
        <input type="text" class="form-control" name="player_position" id="player_position" placeholder="Введите позицию">
        <p>Выберите клуб</p>
        
        <select name="players_team_id">
            <option>
                Выберите клуб
            </option>
            <?php foreach ($teams as $team): ?>
                <option value="<?php echo $team['id']; ?>">
                    <?php echo $team['name']; ?>
                </option>
            <?php endforeach; ?>
        <select>
        <p>
            <button type="submit" class="btn btn-default">
                Создать игрока
            </button>
        </p>
    </div>
</form>