<form action="<?php echo url_for('subscribe_team'); ?>" class="subscribe inline-block" method="post" 
      data-action="<?php echo (get_auth_user() && get_auth_user()->is_subscribed_to_team($team->id)) ? 'delete' : 'subscribe' ?>">
    <button type="submit" id="<?php echo ($team->id); ?>" class="btn btn-default btn-no-border" data-toggle="modal_users_like" data-target=".bs-example-modal-lg">
        <span class="glyphicon icon icon-big 
                     <?php echo (get_auth_user() && get_auth_user()->is_subscribed_to_team($team->id)) ? "glyphicon-star" : "glyphicon-star-empty" ?>
              "></span>
    </button>
</form>