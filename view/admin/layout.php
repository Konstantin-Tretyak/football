<!doctype html>
<html>
    <head>
        <title>
            Football
        </title>
        <meta charset="utf-8">

        <link rel="stylesheet" href="<?php echo ROOT_CATALOGUE; ?>\css\bootstrap.css">
    </head>
    <body>
        <ul class="list-inline">
            <li>
                    Teams
                </a>
                <ul>
                    <li>

                        <a href="<?php echo ROOT_CATALOGUE ?>\admin\teams\index.php">
                            Edit Teams
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo ROOT_CATALOGUE ?>\admin\teams\new.php">
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
                        <a href="<?php echo ROOT_CATALOGUE ?>\admin\games/index.php">
                            Edit Games
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo ROOT_CATALOGUE ?>\admin\games/new.php">
                            Create Games
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                Players
                <ul>
                    <li>
                        <a href="<?php echo ROOT_CATALOGUE ?>\admin\players/new.php">
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

