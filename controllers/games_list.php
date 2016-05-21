<?php

    namespace Controllers\UserPages;

    function game_list_page()
    {
        $data = null;

        $data['games'] = query("SELECT * FROM games", array(), connect());

        ///Work with DB content
            ///$pagin_numb inicialization
                if ( isset($_GET['N']) )
                {
                    if ( is_numeric($_GET['N']) )
                        $data['pagin_numb'] = (int) $_GET['N'];
                    else
                        throw new NotFoundException();
                }
                else
                {
                        $data['pagin_numb'] = 1;
                }
            ///end $pagin_numb inicialization

            /* TODO: simplify this code to get:
               $query = \Game::query()->order_by();
               $games = $query->limit()->offset()->all();

               $total_count = $query->count(); // implement count() method
               $pagination = new Pagination($current_page_num, LIMIT_VIEW_GAMES_INDEX_PAGE, $total_count);

               return view('games_list', compact('games', 'pagination'));

            // 
            //   then init pagination
            */

            ///Взятие игр и имен комманд из БД
            $team = new \Team;
            $temporary_data['last_games'][] = \Game::query();
            $temporary_data['last_games']['home_team_name'] = $team->homeTeamName();
            $temporary_data['last_games']['guest_team_name'] = $team->guestTeamName();

            foreach ($temporary_data['last_games'] as $key => $value_game)
            {
                $temporary_data['last_games'][$key] = $value_game->
                            // TODO: no need to make this global. Make it as local constant 
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

            ///$data['club_name'] = query("SELECT * FROM teams", array(), connect());
            ///Take DB content

            /*$jmsv= json_encode($data['club_name']);

            creat_JSON_file($jmsv, "teams.json");*/
        ///End work with DB content

        /*if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            query_for_change("INSERT INTO user(user_email, team_id)
                              VALUES(:user_email, :team_id)",
                              array('user_email'=>$_POST['user_email'], 'team_id'=>$_POST['user_liked_team_id']),
                              connect());

            $user_data = query("SELECT user_email, user.team_id as user_team_id, teams.id as teams_id, teams.name as user_teams_name
                                FROM user INNER JOIN teams ON user.team_id = teams.id
                                WHERE user_email = :user_email AND user.team_id=:user_team_id",
                               array('user_email'=>$_POST['user_email'], 'user_team_id'=>$_POST['user_liked_team_id']),
                               connect())[0];

            $letter = "Hello, ".$user_data['user_email']."!!! ".$message_for_user['teams_was_add_to_user_liked'].$user_data['user_teams_name'];

            $letter = create_Email_letter($user_data['user_email'], $letter);

            send_Email($letter);

            $_SESSION['message']= $message_for_user['teams_add_to_user_liked'].$user_data['user_teams_name'];

        }*/

        return view('games_list', $data);
    }
