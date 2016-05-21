<?php

    namespace Controllers\Admin\Games;

    function create()
    {
        validate_authorized();
        validate_authorized_as_admin();

        $message_for_admin = message_for_admin();

        $data = null;

        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            validate_input($_POST, ['home_team_id', 'guest_team_id', 'date']);

            /*query_for_change("INSERT INTO games(home_team_id,guest_team_id,home_scores,guest_scores,date) 
                              VALUES(:home_team_id,:guest_team_id,:home_scores,:guest_scores,:date)",
                             array('home_team_id'=>$_POST['home_team_id'],'guest_team_id'=>$_POST['guest_team_id'],
                                    'home_scores'=>$_POST['home_scores'],'guest_scores'=>$_POST['guest_scores'],
                                    'date'=>$_POST['date']),
                             connect());*/

            \Game::create(['home_team_id'=>$_POST['home_team_id'],'guest_team_id'=>$_POST['guest_team_id'],
                              'home_scores'=>$_POST['home_scores'],'guest_scores'=>$_POST['guest_scores'],
                              'date'=>$_POST['date']]);

            //$data['teams'] = query("SELECT * FROM teams", array(), connect());

            /*$user_data = query("SELECT user_email, user.team_id as user_team_id, teams.id as teams_id, teams.name as user_teams_name
                                FROM user INNER JOIN teams ON user.team_id = teams.id
                                WHERE teams.id=:home_team_id OR teams.id=:guest_team_id",
                                array('home_team_id'=>$_POST['home_team_id'], 'guest_team_id'=>$_POST['guest_team_id']),
                                connect());

            $message['game_new'] = "Игра ".$data['teams'][$_POST['home_team_id']-1]['name']." - ".$data['teams'][$_POST['guest_team_id']-1]['name']." состоится ".$_POST['date'];

            foreach ($user_data as $data)
            {
                $letter = create_Email_letter($data['user_email'], $message);
                send_Email($letter);
            }*/

            flash_set('message', $message_for_admin['games_new']);

            if(isset($_POST['page']))
            {
                return redirect($_POST['page']);
            }
        }

        $data['teams'] = \Team::query()->all();

        foreach ($data['teams'] as $key => $value)
        {
            $data['teams'][$key] = $value->toArray();
        }

        return view('admin_games_new', $data, 'admin');
    }

    function index()
    {
        validate_authorized();
        validate_authorized_as_admin();

        $data;

        $data['games'] = \Game::query()->all();

        foreach ($data['games'] as $key => $value)
        {
            $data['games'][$key] = $value->toArray();
        }

        if ($_SERVER['REQUEST_METHOD'] == "GET")
        {
            ///namber of pagination

        ///$pagin_numb inicialization
            if ( isset($_GET['N']) )
            {
                $data['pagin_numb'] = (int) $_GET['N'];
            }
            else 
            {
                $data['pagin_numb'] = 1;
            }
        ///end $pagin_numb inicialization

            ///Взятие игр и имен комманд из БД
            $team = new \Team;
            $temporary_data['last_games'][] = \Game::query();
            $temporary_data['last_games']['home_team_name'] = $team->homeTeamName();
            $temporary_data['last_games']['guest_team_name'] = $team->guestTeamName();

            foreach ($temporary_data['last_games'] as $key => $value_game)
            {
                $temporary_data['last_games'][$key] = $value_game->
                            where('games.id>?', [LIMIT_VIEW_GAMES_INDEX_PAGE * ($data['pagin_numb'] - 1)])->
                            order_by('games.id')->
                            limit(LIMIT_VIEW_GAMES_INDEX_PAGE)->
                            all();

                $i = 0;
                $j=0;
                foreach ($temporary_data['last_games'][$key] as $key_value => $value)
                {
                    if( ($key === 'home_team_name') or ($key === 'guest_team_name') )
                    {
                        $temporary_data['last_games'][0][$i][$key] = $value->toArray()['name'];
                        $i++;
                    }
                    else
                    {
                        $temporary_data['last_games'][0][$j] = $value->toArray();
                        $j++;
                    }
                }
            }

            $data['last_games'] = $temporary_data['last_games'][0];
        // Game::query()->limit(LIMIT_VIEW_GAMES_INDEX_PAGE)->offset(LIMIT_VIEW_GAMES_INDEX_PAGE * ($data['pagin_numb'] - 1))

        // in view.php: $game->home_team->name
        }

        return view('admin_games', $data, 'admin');
    }

    function edit()
    {
        validate_authorized();
        validate_authorized_as_admin();

        $message_for_admin = message_for_admin();

        $data = null;

        ///$current_page inicialization
            if ( isset($_GET['game']) )
            {
                $current_page = (int) $_GET['game'];
            }
            else 
            {
                die("Нет страницы");
            }
        ///end $current_page inicialization


        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $game_temporary;

            $game_old = \Game::query()->where('id=?',[$current_page])->all()[0]->toArray();

            ///Во избежание перезаписи существующих полей пустыми данными производим проверку $_POST
            ///и заполнение временного массива $player_temporary.

            foreach ($_POST as $key => $value)
            {
               if ( $value != "" )
                {
                    if ((!strnatcasecmp($key, "home_scores")) || (!strnatcasecmp($key, "guest_scores")))
                    {
                        if( $date1 = strtotime($game_old['date']) > $date2=strtotime(date('y-m-d')) )
                        {
                            echo $message_for_admin['games_edit_not_start'];  
                            $game_temporary[$key] = $game_old[$key]; 
                            continue;
                        }    
                    }
                    $game_temporary[$key] = $value;
                }
                else
                {
                    $game_temporary[$key] = $game_old[$key];
                }
            }

            \Game::query()->
                   all()[$current_page-1]->
                   update(['home_scores'=>$game_temporary['home_scores'], 'guest_scores'=>$game_temporary['guest_scores'],
                          'date'=>$game_temporary['date'], 'description'=>$game_temporary['description'],
                          'id'=>$current_page])->
                  save();

            $_SESSION['message']=$message_for_admin['games_edit'];


            if(isset($_POST['page']))
            {
                header("Location: {$_POST['page']}");
                exit();
            }
        }

        ///Взятие игр и имен комманд из БД
        $team = new \Team;
        $data['game'] = \Game::query()->where('games.id=?',[$current_page])->all()[0]->toArray();
        $data['game']['home_team_name'] = $team->homeTeamName()->where('games.id=?',[$current_page])->all()[0]->name;
        $data['game']['guest_team_name'] = $team->guestTeamName()->where('games.id=?',[$current_page])->all()[0]->name;

        return view('admin_games_edit' , $data, 'admin');
    }