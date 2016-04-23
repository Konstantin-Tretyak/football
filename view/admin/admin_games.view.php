<h2>
    Матчи
</h2>

<a href="../games/new.php"><button>New Game</button></a>

<table class="table table-striped">
    <?php foreach ($last_games as $last_game): ?>
        <tr>
            <td><?php echo $last_game['date'] ?></td>
            <td>
                <a href="../teams/edit.php?club_id=<?php echo ($last_game['home_team_id']); ?>">
                    <?php echo $last_game['home_team_name'] ?>
                </a>
            </td>
            <td>
                <a href="edit.php?game=<?php echo ($last_game['games_id']); ?>">
                    <?php 
                    if ( strtotime($last_game['date']) <= strtotime(date('y-m-d')) )
                        echo $last_game['home_scores']." - ".$last_game['guest_scores'];
                    else
                        echo "Матч ещё не начался";
                    ?>
                </a>
            </td>
            <td>
                <a href="../teams/edit.php?club_id=<?php echo ($last_game['guest_team_id']); ?>">
                    <?php echo $last_game['guest_team_name'] ?>
                </a>
            </td>
            <td>
                <a href="edit.php?game=<?php echo ($last_game['games_id']); ?>">
                    Edit
                </a>
            </td>
            <td>
                Delete
            </td>
        </tr>

    <?php endforeach; ?>
</table>

<?php
    /// $pagin_numb and $games was extracted at massive $data in the function view('index', $data);
    /// $games - it's a table 'games'
    /// $pagin_numb - it's a number of current page
    $count_pages = ceil(count($games) / LIMIT_VIEW_GAMES_INDEX_PAGE);

    if ( $pagin_numb - 1 > 0 )
    {
        $prev_page = $pagin_numb - 1;
    }
    else
    {
        $prev_page = 1;
    }

    if ($pagin_numb < $count_pages)
    {
        $next_page = $pagin_numb + 1;
    }
    else
    {
        $next_page = $pagin_numb;
    }

    $href = "index.php?N=";
?>

<ul class="pagination">
    <li>
      <a href="index.php?N=<?php echo $prev_page; ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <?php for ($i=1; $i<=$count_pages; $i++): ?>
        <li>
            <a href="index.php?N=<?php echo $i; ?>">
                <?php echo ($i); ?>
            </a>
        </li>
    <?php endfor; ?>
    <li>
      <a href="index.php?N=<?php echo $next_page; ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
</ul>