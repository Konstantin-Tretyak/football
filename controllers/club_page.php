<?php
    $data;

    if (!$conn)
        die("I can't connect DB! I'm sorry!");

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
    $data['team_name'] = query("SELECT name FROM teams WHERE id=:current_team_id",
                                array('current_team_id' => $current_page),
                                $conn)[0];

    ///matches of team
    $data['last_teams_games'] = query("SELECT games.id as games_id, home_team_id, guest_team_id, home_scores, guest_scores, date,
                                        team_home.name as home_team_name,
                                        team_guest.name as guest_team_name
                                FROM (games INNER JOIN teams as team_home ON games.home_team_id = team_home.id
                                            INNER JOIN teams as team_guest ON games.guest_team_id = team_guest.id)
                                WHERE home_team_id=:current_team_id or guest_team_id=:current_team_id  ORDER BY games.id LIMIT ".LIMIT_VIEW_GAMES_INDEX_PAGE,
                                array('current_team_id' => $current_page),
                                $conn);

    $data['team_players'] = query("SELECT * FROM players WHERE team_id=:current_team_id",
                                array('current_team_id' => $current_page),
                                $conn);

    view('club_page', $data);
