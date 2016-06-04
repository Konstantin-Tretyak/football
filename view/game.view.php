<h1>Матч</h1>
<h3>
<!--     <table class="table table-responsive">
        <tr>
            <td class="padding-right-10">
                <a href="<?php echo url_for('club'); ?>?club_id=<?php echo ($game->home_team()->first()->id); ?>">
                    <img src="<?php echo url($game->home_team()->first()->logo ? $game->home_team()->first()->logo : '/img/team-placeholder.png') ?>" height="50px">
                </a>
            </td>
            <td class="padding-right-10">
                <a href="<?php echo url_for('club'); ?>?club_id=<?php echo ($game->home_team()->first()->id); ?>">
                    <?php echo $game->home_team()->first()->name ?>
                </a>
            </td>
            <td class="padding-right-10">
                <?php 
                if ( strtotime($game->date) <= strtotime(date('y-m-d')) )
                    echo $game->home_scores." - ".$game->guest_scores;
                else
                    echo "- : -";
                ?>
            </td>
            <td class="padding-right-10">
                <a href="<?php echo url_for('club'); ?>?club_id=<?php echo ($game->guest_team()->first()->id); ?>">
                    <?php echo $game->guest_team()->first()->name ?></td>
                </a>
            </td>
            <td class="padding-right-10">
                <a href="<?php echo url_for('club'); ?>?club_id=<?php echo ($game->guest_team()->first()->id); ?>">
                    <img src="<?php echo url($game->guest_team()->first()->logo ? $game->guest_team()->first()->logo : '/img/team-placeholder.png') ?>" height="50px">
                </a>
            </td>
        </tr>
    </table> -->

    <div class="row">
        <div class="col-xs-2">
            <a href="<?php echo url_for('club'); ?>?club_id=<?php echo ($game->home_team()->first()->id); ?>">
                <img src="<?php echo url($game->home_team()->first()->logo ? $game->home_team()->first()->logo : '/img/team-placeholder.png') ?>" height="50px">
            </a>
        </div>
        <div class="col-xs-3">
            <a href="<?php echo url_for('club'); ?>?club_id=<?php echo ($game->home_team()->first()->id); ?>">
                <?php echo $game->home_team()->first()->name ?>
            </a>
        </div>
        <div class="col-xs-2">
            <?php 
            if ( strtotime($game->date) <= strtotime(date('y-m-d')) )
                echo $game->home_scores." - ".$game->guest_scores;
            else
                echo "- : -";
            ?>
        </div>
        <div class="col-xs-3">
            <a href="<?php echo url_for('club'); ?>?club_id=<?php echo ($game->guest_team()->first()->id); ?>">
                <?php echo $game->guest_team()->first()->name ?>
            </a>
        </div>
        <div class="col-xs-2">
            <a href="<?php echo url_for('club'); ?>?club_id=<?php echo ($game->guest_team()->first()->id); ?>">
                <img src="<?php echo url($game->guest_team()->first()->logo ? $game->guest_team()->first()->logo : '/img/team-placeholder.png') ?>" height="50px">
            </a>
        </div>
    </div>    
</h3>

<p><span class="glyphicon glyphicon-time margin-right-10"></span><?php echo $game->date ?></p>

<div class="well">
    <?php 
        if ( $game->description )
        {
            echo $game->description; 
        }
        else
        {
            echo "К матчу нет описания";
        }
    ?>
</div>

<legend>Комментарии</legend>
<form action="<?php echo url(url_for('create_comment'))."?game=".$game->id; ?>" class="comment" method="post">
    <div class="form-group">
        <textarea class="form-control comment_area" rows="5" name="body" id="body"></textarea>
    </div>
        <button type="submit" class="btn btn-primary" id="sub_comment">Комментировать</button>
</form>
<hr>

<ul class="comments list-unstyled">
    <?php foreach ($comments as $comment) : ?>
        <li>
            <p>
                <span class="glyphicon glyphicon-comment margin-right-10"></span>
                <?php echo $comment->author_name; ?> в <i><?php echo $comment->date; ?></i>
            </p>
            <blockquote>
                <?php echo nl2br($comment->body); ?>
            </blockquote>
            <hr>
        </li>
    <?php endforeach ?>
</ul>
