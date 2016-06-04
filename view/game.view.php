<a href="/">На главную</a>
<h1>Матч</h1>

<h3>
    <?php
        if (strtotime($game->date) <= strtotime(date('y-m-d')))
            $score = $game->home_scores."-".$game->guest_scores;
        else
            $score = "|-| - |-|";
        echo $game->home_team()->first()->name." ".$score." ".$game->guest_team()->first()->name;
    ?>
</h3>

<h4>
    <?php echo $game->date; ?>
</h4>

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

<form action="<?php echo url(url_for('create_comment'))."?game=".$game->id; ?>" class="comment" method="post">
    <div class="form-group">
        <textarea class="comment_area" name="body" id="body"></textarea>
        <button type="submit" class="btn btn-default" id="sub_comment">Комментировать</button>
    </div>
</form>

<ul class="comments list-unstyled">
    <?php foreach ($comments as $comment) : ?>
        <li class="comment">
            <h3>
                <?php echo $comment->author_name; ?>
            </h3>
            <h4>
                <?php echo $comment->body; ?>
            </h4>
            <p>
                <?php echo $comment->date; ?>
            </p>
        </li>
    <?php endforeach ?>
</ul>
