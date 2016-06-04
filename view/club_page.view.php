<a href="/">На главную</a>

<h1>
    <?php echo $team->name; ?>
</h1>

    <form action="<?php echo url_for('subscribe_team'); ?>" class="subscribe" method="post">
        <button type="submit" class="
        <?php
            if ( is_user_club($team->id) )
                echo "btn btn-danger";
            else
                echo "btn btn-primary";
        ?>"
        id="<?php echo ($team->id); ?>" data-toggle="modal_users_like" data-target=".bs-example-modal-lg">
            <span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
        </button>
    </form>
<h3>
    Последние матчи комманды
</h3>

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
        </tr>
    <?php endforeach ?>
</table>

<?php require BASE_DIR.'/view/'."pagination.view.php";?>

<h3>
    Игроки комманды
</h3>


<table class="table table-striped">
    <?php 
        if ($team->players()->all())
        {
           foreach ($team->players()->all() as $player)
           {
                echo "<tr>
                        <td>{$player->name}</td>
                        <td>{$player->position}</td>
                      </tr>";
            }
        }
        else
        {
            echo "Пока ни один игрок не был внесён в базу данных";
        }
    ?>
</table>
