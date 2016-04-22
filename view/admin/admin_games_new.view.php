<h1>
    New Game
</h1>

<form action="" method="post">
    <p>
        <label for="home_team_id">Хозяева</label>
        <select name="home_team_id" id="home_team_id">
            <option>
            </option>
            <?php foreach ($teams as $team): ?>
                <option value="<?php echo $team['id']; ?>">
                    <?php echo $team['name']; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="home_scores">Голы</label>
        <input type="text" name="home_scores" id="home_scores"></input>
    </p>

    <p>
        <label for="guest_team_id">Гости</label>
        <select name="guest_team_id" id="guest_team_id">
            <option>
            </option>
            <?php foreach ($teams as $team): ?>
                <option value="<?php echo $team['id']; ?>">
                    <?php echo $team['name']; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="guest_scores">Голы</label>
        <input type="text" name="guest_scores" id="guest_scores"></input>
    </p>

    <p>
        <label for="date">Дата</label>
        <input type="text" name="date" id="date"></input>
    </p>

    <p>
        <button type="submit" class="btn btn-default">Создать игру</button>
        <button type="submit" name="page" value="index.php" class="btn btn-default">Изменить название</button>
    </p>
</form>