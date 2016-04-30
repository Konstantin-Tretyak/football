<a href="/">На главную</a>
<h1>Матч</h1>

<h3>
    <?php
        if (strtotime($game['date']) <= strtotime(date('y-m-d')))
            $score = $game['home_scores']."-".$game['guest_scores'];
        else
            $score = "|-| - |-|";
        echo $game['home_team_name']." ".$score." ".$game['guest_team_name'];
    ?>
</h3>

<h4>
    <?php echo $game['date']; ?>
</h4>

    <?php 
        if ( $game['description'] )
        {
            echo $game['description']; 
        }
        else
        {
            echo "К матчу нет описания";
        }
    ?>

<form action="" method="post">
    <div class="form-group">
        <label for="user">Кто ты?</label>
        <input type="text" class="form-control" name="user" id="user" placeholder="Кто ты?">
        <textarea name="body" id="body"></textarea>
        <button type="submit" class="btn btn-default">Комментировать</button>
    </div>
</form>

<?php foreach ($comments as $comment) : ?>
    <h3>
        <?php echo $comment['author_name']; ?>
    </h3>
    <h4>
        <?php echo $comment['body']; ?>
    </h4>
    <p>
        <?php echo $comment['date']; ?>
    </p>
<?php endforeach ?>