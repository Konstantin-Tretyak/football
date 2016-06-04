<h1>Управление командами</h1>
<p>
    <a class="btn btn-success" href="<?php echo url_for('admin_teams_new'); ?>">Создать команду</a>
</p>

<table class="table table-striped games">
    <?php foreach($teams as $team): ?>
        <tr>
            <td>
                <a href="<?php echo url_for('admin_teams_edit'); ?>?club_id=<?php echo ($team->id); ?>">
                    <img src="<?php echo url($team->logo ? $team->logo : '/img/team-placeholder.png') ?>" height="30px">
                </a>
            </td>        
            <td>
                <a href="<?php echo url_for('admin_teams_edit'); ?>?club_id=<?php echo ($team->id); ?>">
                    <?php echo $team->name; ?>
                </a>
            </td>
            <td>
                <a href="<?php echo url_for('admin_teams_edit'); ?>?club_id=<?php echo ($team->id); ?>">
                    Edit
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>