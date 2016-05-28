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

            \Game::create(['home_team_id'=>$_POST['home_team_id'],'guest_team_id'=>$_POST['guest_team_id'],
                              'home_scores'=>$_POST['home_scores'],'guest_scores'=>$_POST['guest_scores'],
                              'date'=>$_POST['date']]);

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

        define('LIMIT_PAGE', 5);

        ///Work with DB content

            $query_game = \Game::query();
            $total_count = $query_game->count();

            $data['pagination'] = new \Pagination(LIMIT_PAGE, $total_count);

            ///Взятие игр и имен комманд из БД
            $team = new \Team;
            $temporary_data['last_games'][] = \Game::query();
            $temporary_data['last_games']['home_team_name'] = $team->homeTeamName();
            $temporary_data['last_games']['guest_team_name'] = $team->guestTeamName();

            foreach ($temporary_data['last_games'] as $key => $value_game)
            {
                $temporary_data['last_games'][$key] = $value_game->
                            order_by('games.id')->
                            offset(LIMIT_PAGE * ($data['pagination']->page - 1),LIMIT_PAGE)->
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