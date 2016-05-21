<a href="/">На главную</a>

<h1>
    <?php echo $team_name['name']; ?>
</h1>

<h3>
    Последние матчи комманды
</h3>

<table class="table table-striped">
    <?php foreach ($last_teams_games as $last_game): ?>
        <tr>
            <td><?php echo $last_game['date'] ?></td>
            <td>
                <a href="<?php echo url_for('club'); ?>?club_id=<?php echo ($last_game['home_team_id']); ?>">
                    <?php echo $last_game['home_team_name'] ?>
                </a>
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
        </tr>
    <?php endforeach ?>
</table>

<h3>
    Игроки комманды
</h3>


<table class="table table-striped">
    <?php 
        if ($team_players)
        {
           foreach ($team_players as $team_player)
           {
                echo "<tr>
                        <td>{$team_player->name}</td>
                        <td>{$team_player->position}</td>
                      </tr>";
            }
        }
        else
        {
            echo "Пока ни один игрок не был внесён в базу данных";
        }
    ?>
</table>