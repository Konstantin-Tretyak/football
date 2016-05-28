<h1>
    Главная страница. Главнее не бывает.
</h1>

<h2>
    Матчи
</h2>

<table class="table table-striped">
    <?php foreach ($games as $game): ?>
        <tr>
            <td><?php echo $game->date ?></td>
            <td>
                <a href="<?php echo url_for('club'); ?>?club_id=<?php echo ($game->home_team()->first()->id); ?>">
                    <?php echo $game->home_team()->first()->name ?>
                </a>
            </td>
            <td>
                <form action="http://my_football.local:81/?N=<?php echo $pagination->page; ?>" class="subscribe" method="post">
                    <button type="submit" class="
                    <?php
                        // TODO
                        if ( $current_user->is_subscribed_to_team($game->home_team()->first()->id) )
                            echo "btn btn-danger";
                        else
                            echo "btn btn-primary";
                    ?>"
                    id="<?php echo ($game->home_team()->first()->id); ?>" data-toggle="modal_users_like" data-target=".bs-example-modal-lg">
                        <span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
                    </button>
                </form>
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

                <form action="http://my_football.local:81/?N=<?php echo $pagination->page; ?>" class="subscribe" method="post">
                    <button type="submit" class="
                    <?php
                        if ( $current_user->is_subscribed_to_team($game->guest_team()->first()->id) )
                            echo "btn btn-danger";
                        else
                            echo "btn btn-primary";
                    ?>"
                    id="<?php echo ($game->guest_team()->first()->id); ?>" data-toggle="modal_users_like" data-target=".bs-example-modal-lg">
                        <span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
                    </button>
                </form>
            </td>            
        </tr>
    <?php endforeach ?>
</table>

<?php require BASE_DIR.'/view/'."pagination.view.php";?>