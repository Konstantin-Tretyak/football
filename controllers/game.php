<?php
    
    namespace Controllers\UserPages;

    function game_page()
    {
        $data = null;
        ///$current_page inicialization

            if ( isset($_GET['game']) && is_numeric($_GET['game']) )
            {
                $current_page = (int) $_GET['game'];
            }
            else 
            {
                throw new NotFoundException();
            }
        ///end $current_page inicialization

        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            validate_authorized();
            validate_input($_POST, ['body']);

            $comment = \Comment::create(['game_id' => $current_page, 'author_name' => get_authorized_user()['login'], 'date'=>date('Y-m-d H:i:s'), 'body'=>$_POST['body']]);

            if (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == strtolower('xmlhttprequest'))
            {
                return json_encode($comment->toArray());
            }
            
        }

        ///Взятие игр и имен комманд из БД
        $team = new \Team;
        $data['game'] = \Game::query()->all()[$current_page-1]->toArray();
        $data['game']['home_team_name'] = $team->homeTeamName()->
                                            where("games.id=?",[$current_page])->all()[0]->name;
        $data['game']['guest_team_name'] = $team->guestTeamName()->
                                            where("games.id=?",[$current_page])->all()[0]->name;

        ///Взятие комментариев из БД
        $data['comments'] = \Comment::query()->where('game_id = ?', [$current_page])->order_by("date", "up")->all();
        foreach ($data['comments'] as $key => $value)
        {
            $data['comments'][$key] = $value->toArray();
        }
        
        return view('game', $data);
    }
