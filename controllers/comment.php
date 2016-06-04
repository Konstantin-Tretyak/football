<?php

    namespace Controllers\Comment;

    function create_entity()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            validate_authorized();
            validate_input($_POST, ['body']);

            $comment = \Comment::create(['game_id' => $_GET['game'], 'author_name' => get_authorized_user()['login'], 'date'=>date('Y-m-d H:i:s'), 'body'=>$_POST['body']]);

            if (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == strtolower('xmlhttprequest'))
            {
                return json_encode($comment->toArray());
            }
        }
    }