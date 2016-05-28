<?php
    namespace Controllers\UserPages;

    function club_page()
    {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == strtolower('xmlhttprequest'))
        {
            return subscribe_team();
        }

        $data = null;
        define('LIMIT_PAGE', 5);

        //var_dump(subscribe_team($_POST));
        ///$current_page inicialization
            // TODO: не просто проверять isset , а наличие такого club_id в БД
            if ( isset($_GET['club_id']) && is_numeric($_GET['club_id']) )
            {
                $current_page = $_GET['club_id'];
            }
            else
            {
                throw new NotFoundException();
            }

        $team = \Team::find($current_page);
        $players = $team->players()->all();
        // var_dump($players);//die();
        // var_dump($players[0]->team());die();

        foreach ($team->games() as $game) {
            echo $game->home_team()->first()->name." ".$game->home_scores." - ".$game->guest_scores." ".$game->guest_team()->first()->name."<br/>";
        }
        die();
        // $ga = \Team::find($current_page);
        return view('club_page_new', ['team' => $team]);

        // var_dump($team->games_as_home());die();
        // var_dump($team->games_as_home()->all());die();
        ///name of current team
        //     $data['team_name'] = \Team::query()->where('id = ?', [$current_page])->all()[0]->toArray();


        //     $query_game = \Game::query();
        //     $total_count = $query_game->where('(home_team_id=? or guest_team_id=?)', [$current_page, $current_page])->
        //                                 count();

        //     echo $total_count;

        //     // TODO: do pagination like here
        //     $page_num = \BaseController::get_current_page_num();
        //     $pagination = new \Pagination(LIMIT_PAGE, $total_count, $page_num);
        //     // TODO: 
        //     // if ($page_num > $pagination->pages_quantity()) {
        //     //     return redirect(<current page withount N param>)
        //     // }
        //     $data['pagination'] = $pagination;

        //     ///Взятие игр и имен комманд из БД
        //     $team = new \Team;
        //     $temporary_data['last_teams_games'][] = \Game::query();
        //     $temporary_data['last_teams_games']['home_team_name'] = $team->homeTeamName();
        //     $temporary_data['last_teams_games']['guest_team_name'] = $team->guestTeamName();

        //     // TODO: отображать количество комментариев к матчу
        //     foreach ($temporary_data['last_teams_games'] as $key => $value_game)
        //     {
        //         $temporary_data['last_teams_games'][$key] = $value_game->
        //                     where('(home_team_id=? or guest_team_id=?)', [$current_page, $current_page])->
        //                     order_by('games.id')->
        //                     offset(LIMIT_PAGE * ($data['pagination']->page - 1),LIMIT_PAGE)->
        //                     all();

        //         $i = 0;
        //         $j=0;
        //         foreach ($temporary_data['last_teams_games'][$key] as $key_value => $value)
        //         {
        //             if( ($key === 'home_team_name') or ($key === 'guest_team_name') )
        //             {
        //                 $temporary_data['last_teams_games'][0][$i][$key] = $value->toArray()['name'];
        //                 $i++;
        //             }
        //             else
        //             {
        //                 $temporary_data['last_teams_games'][0][$j] = $value->toArray();
        //                 $j++;
        //             }
        //         }
        //     }

        //     $data['last_teams_games'] = $temporary_data['last_teams_games'][0];

        // $data['team_players'] = \Player::query()->where('team_id=?',[$current_page])->all();

        // return view('club_page', $data);
    }
