<h2>
    Матчи
</h2>

<a href="../games/new"><button>New Game</button></a>

<table class="table table-striped">
    <?php foreach ($last_games as $last_game): ?>
        <tr>
            <td><?php echo $last_game['date'] ?></td>
            <td>
                <a href="<?php echo url(url_for('admin_teams_edit')); ?>?club_id=<?php echo ($last_game['home_team_id']); ?>">
                    <?php echo $last_game['home_team_name'] ?>
                </a>
            </td>
            <td>
                <a href="<?php echo url(url_for('admin_games_edit')); ?>?game=<?php echo ($last_game['id']); ?>">
                    <?php 
                    if ( strtotime($last_game['date']) <= strtotime(date('y-m-d')) )
                        echo $last_game['home_scores']." - ".$last_game['guest_scores'];
                    else
                        echo "Матч ещё не начался";
                    ?>
                </a>
            </td>
            <td>
                <a href="<?php echo url(url_for('admin_teams_edit')); ?>?club_id=<?php echo ($last_game['guest_team_id']); ?>">
                    <?php echo $last_game['guest_team_name'] ?>
                </a>
            </td>
            <td>
                <a href="<?php echo url(url_for('admin_games_edit')); ?>?game=<?php echo ($last_game['id']); ?>">
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