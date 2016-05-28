<a href="/">На главную</a>
<h2>Избранные комманды <?php echo $user; ?></h2>

<table class="table table-striped games">
    <?php foreach($user_teams as $user_team): ?>
        <tr>
            <td>
                <?php echo $user_team['name']; ?>
            </td>
            <td>
                <form action="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>" class="subscribe" method="post">
                    <button type="submit" class="
                    <?php
                        if ( is_user_club($user_team['id']) )
                            echo "btn btn-danger";
                        else
                            echo "btn btn-primary";
                    ?>"
                    id="<?php echo ($user_team['id']); ?>" data-toggle="modal_users_like" data-target=".bs-example-modal-lg">
                        <span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
                    </button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require BASE_DIR.'/view/'."pagination.view.php";?>

