<?php

    namespace Controllers\UserPages;

    function game_list_page()
    {
        $data = null;

        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == strtolower('xmlhttprequest'))
        {
            return subscribe_team();
        }

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

        return view('games_list', $data);
    }
