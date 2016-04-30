<!doctype html>
<html>
    <head>
        <title>
            Football
        </title>
        <meta charset="utf-8">

        <link rel="stylesheet" href="<?php echo url('/css/bootstrap.css'); ?>">
        <link rel="stylesheet" href="<?php echo url('/css/css.css'); ?>">
    </head>
    <body>
        <ul class="list-inline">
            <li>
                    Teams
                </a>
                <ul>
                    <li>

                        <a href="<?php echo url_for('admin_teams'); ?>">
                            Edit Teams
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo url_for('admin_teams_new'); ?>">
                            Create New Team
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                    Games
                </a>
                <ul>
                    <li>
                        <a href="<?php echo url_for('admin_games'); ?>">
                            Edit Games
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo url_for('admin_games_new'); ?>">
                            Create Games
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                Players
                <ul>
                    <li>
                        <a href="<?php echo url_for('admin_players_new'); ?>">
                            Create Player
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <?php
            include($path);
        ?>

    </body>
</html>

