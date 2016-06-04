<h1>
    Edit Game
</h1>
<h2>
    <div class="row">
        <div class="col-xs-2">
            <a href="<?php echo url_for('admin_teams_edit'); ?>?club_id=<?php echo ($game->home_team()->first()->id); ?>">
                <img src="<?php echo url($game->home_team()->first()->logo ? $game->home_team()->first()->logo : '/img/team-placeholder.png') ?>" height="50px">
            </a>
        </div>
        <div class="col-xs-3">
            <a href="<?php echo url_for('admin_teams_edit'); ?>?club_id=<?php echo ($game->home_team()->first()->id); ?>">
                <?php echo $game->home_team()->first()->name ?>
            </a>
        </div>
        <div class="col-xs-2">
            <?php 
            if ( strtotime($game->date) <= strtotime(date('y-m-d')) )
                echo $game->home_scores." - ".$game->guest_scores;
            else
                echo "- : -";
            ?>
        </div>
        <div class="col-xs-3">
            <a href="<?php echo url_for('admin_teams_edit'); ?>?club_id=<?php echo ($game->guest_team()->first()->id); ?>">
                <?php echo $game->guest_team()->first()->name ?>
            </a>
        </div>
        <div class="col-xs-2">
            <a href="<?php echo url_for('admin_teams_edit'); ?>?club_id=<?php echo ($game->guest_team()->first()->id); ?>">
                <img src="<?php echo url($game->guest_team()->first()->logo ? $game->guest_team()->first()->logo : '/img/team-placeholder.png') ?>" height="50px">
            </a>
        </div>
    </div>    
</h2>

<form action="<?php echo url(url_for('admin_games_edit_entity'))."?game=".$game->id; ?>" method="post">
    <ul class="list-unstyled">
        <?php foreach ($errors as $error): ?>
            <li><?php echo $error; ?></li>
        <?php endforeach; ?>
    </ul>

    <div class="form-group">
        <label for="home_scores">Голы хозяев</label>
        <input class="form-control" type="text" name="home_scores" id="home_scores" value="<?php echo $game->home_scores; ?>">
    </div>

    <div class="form-group">
        <label for="guest_scores">Голы гостей</label>
        <input class="form-control" type="text" name="guest_scores" id="guest_scores" value="<?php echo $game->guest_scores; ?>">
    </div>

    <div class="form-group">
        <label for="date">Дата</label>
        <input class="form-control" type="text" name="date" id="date" value="<?php echo $game->date; ?>">
    </div>

    <div class="form-group">
        <label>Описание</label>
        <textarea rows="5" class="form-control" name="description"><?php echo $game->description; ?></textarea>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Сохранить и продолжить</button>
        <button type="submit" name="page" value="<?php echo url(url_for('admin_games')) ?>" class="btn btn-primary">Сохранить</button>
    </div>
</form>