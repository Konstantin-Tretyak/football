<?php
    $data;

    namespace Controllers\UserPages;

    function club_page()
    {
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
        ///end $current_page inicialization

        ///name of current team
        $data['team_name'] = \Team::query()->where('id = ?', [$current_page])->all()[0]->toArray();

        ///matches of team
        /*$data['last_teams_games'] = query("SELECT games.id as games_id, home_team_id, guest_team_id, home_scores, guest_scores, date,
                                            team_home.name as home_team_name,
                                            team_guest.name as guest_team_name
                                    FROM (games INNER JOIN teams as team_home ON games.home_team_id = team_home.id
                                                INNER JOIN teams as team_guest ON games.guest_team_id = team_guest.id)
                                    WHERE home_team_id=:current_team_id or guest_team_id=:current_team_id  ORDER BY games.id LIMIT ".LIMIT_VIEW_GAMES_INDEX_PAGE,
                                    array('current_team_id' => $current_page),
                                    connect());*/

            ///Взятие игр и имен комманд из БД
            $team = new \Team;
            $temporary_data['last_teams_games'][] = \Game::query();
            $temporary_data['last_teams_games']['home_team_name'] = $team->homeTeamName();
            $temporary_data['last_teams_games']['guest_team_name'] = $team->guestTeamName();

            foreach ($temporary_data['last_teams_games'] as $key => $value_game)
            {
                $temporary_data['last_teams_games'][$key] = $value_game->
                            where('(home_team_id=? or guest_team_id=?)', [$current_page, $current_page])->
                            order_by('games.id')->
                            limit(LIMIT_VIEW_GAMES_INDEX_PAGE)->
                            all();

                $i = 0;
                $j=0;
                foreach ($temporary_data['last_teams_games'][$key] as $key_value => $value)
                {
                    if( ($key === 'home_team_name') or ($key === 'guest_team_name') )
                    {
                        $temporary_data['last_teams_games'][0][$i][$key] = $value->toArray()['name'];
                        $i++;
                    }
                    else
                    {
                        $temporary_data['last_teams_games'][0][$j] = $value->toArray();
                        $j++;
                    }
                }
            }

            $data['last_teams_games'] = $temporary_data['last_teams_games'][0];

        $data['team_players'] = query("SELECT * FROM players WHERE team_id=:current_team_id",
                                    array('current_team_id' => $current_page),
                                    connect());

        $data['team_players'] = \Player::query()->where('team_id=?',[$current_page])->all();

        return view('club_page', $data);
    }
