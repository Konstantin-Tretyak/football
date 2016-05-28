<h1>
    Главная страница. Главнее не бывает.
</h1>

<h2>
    Матчи
</h2>

<table class="table table-striped games">
    <?php foreach ($last_games as $last_game): ?>
        <tr>
            <td><?php echo $last_game['date'] ?></td>
            <td>
                <a href="<?php echo url_for('club'); ?>?club_id=<?php echo ($last_game['home_team_id']); ?>">
                    <?php echo $last_game['home_team_name'] ?>
                </a>
            </td>
            <td>
                <form action="http://my_football.local:81/?N=<?php echo $pagination->page; ?>" class="subscribe" method="post">
                    <button type="submit" class="
                    <?php
                        if ( is_user_club($last_game['home_team_id']) )
                            echo "btn btn-danger";
                        else
                            echo "btn btn-primary";
                    ?>"
                    id="<?php echo ($last_game['home_team_id']); ?>" data-toggle="modal_users_like" data-target=".bs-example-modal-lg">
                        <span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
                    </button>
                </form>
            </td>
            <td>
                <a href="<?php echo url_for('game'); ?>?game=<?php echo ($last_game['id']); ?>">
                    <?php 
                    if ( strtotime($last_game['date']) <= strtotime(date('y-m-d')) )
                        echo $last_game['home_scores']." - ".$last_game['guest_scores'];
                    else
                        echo "Матч ещё не начался";
                    ?>
                </a>
                </a>
            </td>
            <td>
                <a href="<?php echo url_for('club'); ?>?club_id=<?php echo ($last_game['guest_team_id']); ?>">
                    <?php echo $last_game['guest_team_name'] ?></td>
                </a>
            </td>
            <td>
                <form action="http://my_football.local:81/?N=<?php echo $pagination->page; ?>" class="subscribe" method="post">
                    <button type="submit" class="
                    <?php
                        if ( is_user_club($last_game['guest_team_id']) )
                            echo "btn btn-danger";
                        else
                            echo "btn btn-primary";
                    ?>"
                    id="<?php echo ($last_game['guest_team_id']); ?>" data-toggle="modal_users_like" data-target=".bs-example-modal-lg">
                        <span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
                    </button>
                </form>
            </td>

        </tr>

    <?php endforeach; ?>
</table>

<?php require BASE_DIR.'/view/'."pagination.view.php";?>