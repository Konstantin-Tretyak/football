<h2>
    Матчи
</h2>

<a href="../games/new"><button>New Game</button></a>

<table class="table table-striped">
    <?php foreach ($games as $game): ?>
        <tr>
            <td><?php echo $game->date ?></td>
            <td>
                <a href="<?php echo url(url_for('admin_teams_edit')); ?>?club_id=<?php echo ($game->home_team()->first()->id); ?>">
                    <?php echo $game->home_team()->first()->name ?>
                </a>
            </td>            
            <td>
                <a href="<?php echo url_for('game'); ?>?game=<?php echo ($game->id); ?>">
                    <?php 
                    if ( strtotime($game->date) <= strtotime(date('y-m-d')) )
                        echo $game->home_scores." - ".$game->guest_scores;
                    else
                        echo "Матч ещё не начался";
                    ?>
                </a>
                </a>
            </td>
            <td>
                <a href="<?php echo url_for('club'); ?>?club_id=<?php echo ($game->guest_team()->first()->id); ?>">
                    <?php echo $game->guest_team()->first()->name ?></td>
                </a>
            </td>
            <td>
                <a href="<?php echo url(url_for('admin_games_edit')); ?>?game=<?php echo ($game->id); ?>">
                    Edit
                </a>
            </td>
            <td>
                Delete
            </td>
        </tr>

    <?php endforeach; ?>
</table>

<?php require BASE_DIR.'/view/'."pagination.view.php";?>