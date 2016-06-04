<h1 class="inline-block clearfix">
    <div class="pull-left margin-right-20">
        <a href="<?php echo url_for('club'); ?>?club_id=<?php echo ($team->id); ?>">
            <img src="<?php echo url($team->logo ? $team->logo : '/img/team-placeholder.png') ?>" height="100px">
        </a>
    </div>
    <?php echo $team->name; ?>
    <?php require BASE_DIR.'/view/common/subscribe_button.view.php';?>
</h1>    
<h3>
    Матчи
</h3>

<?php require BASE_DIR.'/view/common/games_list.view.php';?>

<h3>Игроки</h3>
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
