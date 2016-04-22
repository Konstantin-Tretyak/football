<h1>
    Edit team <?php echo $team['name']; ?>
</h1>

<form action="" method="post">
    <div class="form-group">
        <label for="change_club_name">Изменить название</label>
        <input type="text" class="form-control" name="name" id="change_club_name" placeholder="<?php echo $team['name']; ?>">
        <button type="submit" class="btn btn-default">Изменить название и продолжить</button>
        <button type="submit" name="page" value="index.php" class="btn btn-default">Изменить название</button>
    </div>
</form>

<h2>
    Players
</h2>

<a href="../players/new.php"><button class="btn btn-default">New Player</button></a>

<table>
    <?php foreach($players as $player): ?>
        <tr>
            <td>
                <?php echo $player['name']; ?>
            </td>
            <td>
                <a href="../players/edit.php?player_id=<?php echo $player['id'] ?>">
                    Edit
                </a>
            </td>
            <td>
                Delete
            </td>
        </tr>
    <?php endforeach; ?>
</table>