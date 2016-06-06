<table class="table table-striped">
    <?php foreach ($games as $game): ?>

        <tr>
            <td><?php echo $game->date ?></td>
            <td>
                <a href="<?php echo url_for('club'); ?>?club_id=<?php echo ($game->home_team()->first()->id); ?>">
                    <img src="<?php echo url($game->home_team()->first()->logo ? $game->home_team()->first()->logo : '/img/team-placeholder.png') ?>" height="30px">
                </a>
            </td>
            <td>
                <a href="<?php echo url_for('club'); ?>?club_id=<?php echo ($game->home_team()->first()->id); ?>">
                    <?php echo $game->home_team()->first()->name ?>
                </a>
            </td>
            <td>
                <a href="<?php echo url_for('game'); ?>?game=<?php echo ($game->id); ?>">
                    <?php 
                    if ( strtotime($game->date) <= strtotime(date('y-m-d')) )
                        echo $game->home_scores." - ".$game->guest_scores;
                    else
                        echo "- : -";
                    ?>
                </a>
                </a>
            </td>
            <td>
                <a href="<?php echo url_for('club'); ?>?club_id=<?php echo ($game->guest_team()->first()->id); ?>">
                    <?php echo $game->guest_team()->first()->name ?>
                </a>
            </td>
            <td>
                <a href="<?php echo url_for('club'); ?>?club_id=<?php echo ($game->guest_team()->first()->id); ?>">
                    <img src="<?php echo url($game->guest_team()->first()->logo ? $game->guest_team()->first()->logo : '/img/team-placeholder.png') ?>" height="30px">
                </a>
            </td>
        </tr>
    <?php endforeach ?>
</table>

<?php require BASE_DIR.'/view/common/pagination.view.php';?>