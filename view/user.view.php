<a href="/">На главную</a>
<h2>Избранные комманды <?php echo $current_user->login; ?></h2>

<table class="table table-striped games">
    <?php foreach($user_teams as $user_team): ?>
        <tr>
            <td>
                <?php echo $user_team->name; ?>
            </td>
            <td>
                <form action="<?php echo url_for('subscribe_team'); ?>" class="subscribe" method="post">
                    <button type="submit" class="
                    <?php
                        if ( $current_user && $current_user->is_subscribed_to_team($user_team->id) )
                            echo "btn btn-danger";
                        else
                            echo "btn btn-primary";
                    ?>"
                    id="<?php echo ($user_team->id); ?>" data-toggle="modal_users_like" data-target=".bs-example-modal-lg">
                        <span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
                    </button>
                </form>
            </td>  
        </tr>
    <?php endforeach; ?>
</table>

<?php require BASE_DIR.'/view/'."pagination.view.php";?>

