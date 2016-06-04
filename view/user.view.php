<h2>Избранные команды <?php echo $current_user->login; ?></h2>

<table class="table table-striped games">
    <?php foreach($user_teams as $team): ?>
        <tr>
            <td>
                <a href="<?php echo url_for('club'); ?>?club_id=<?php echo ($team->id); ?>">
                    <img src="<?php echo url($team->logo ? $team->logo : '/img/team-placeholder.png') ?>" height="30px">
                </a>
            </td>        
            <td>
                <a href="<?php echo url_for('club'); ?>?club_id=<?php echo ($team->id); ?>">
                    <?php echo $team->name; ?>
                </a>
            </td>
            <td>
                <?php require BASE_DIR.'/view/common/subscribe_button.view.php';?>
            </td>  
        </tr>
    <?php endforeach; ?>
</table>

<?php require BASE_DIR.'/view/common/pagination.view.php';?>

