<h1>
    Edit Game
</h1>
<h2>
    <?php
        if (strtotime($game['date']) <= strtotime(date('y-m-d')))
            $score = $game['home_scores']."-".$game['guest_scores'];
        else
            $score = "|-| - |-|";
        echo $game['home_team_name']." ".$score." ".$game['guest_team_name'];
    ?>
</h2>

<form action="" method="post">
    <p>
        <label for="home_scores">Голы хозяев</label>
        <input type="text" name="home_scores" id="home_scores">
    </p>

    <p>
        <label for="guest_scores">Голы гостей</label>
        <input type="text" name="guest_scores" id="guest_scores">
    </p>

    <p>
        <label for="date">Дата</label>
        <input type="text" name="date" id="date">
    </p>

    <p>
        Description
        <textarea name="description"></textarea>
    </p>

    <button type="submit" class="btn btn-default">Изменить название и продолжить</button>
        <button type="submit" name="page" value="<?php echo url(url_for('admin_games')) ?>" class="btn btn-default">Изменить название</button>
</form>