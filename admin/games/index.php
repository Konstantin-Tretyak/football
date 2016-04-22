<?php
    require '../../settings.php';

    session_start();
    //Connect to the DATA BASE
    $conn = connect($config);

    $data;

    if (!$conn)
        die("I can't connect DB! I'm sorry!");

    $data['games'] = query("SELECT * FROM games", array(), $conn);

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

    $data['last_games'] = query("SELECT games.id as games_id, home_team_id, guest_team_id, home_scores, guest_scores, date,
                                        team_home.name as home_team_name, 
                                        team_guest.name as guest_team_name 
                                FROM (games INNER JOIN teams as team_home ON games.home_team_id = team_home.id 
                                            INNER JOIN teams as team_guest ON games.guest_team_id = team_guest.id) 
                                WHERE games.id>:N  ORDER BY games.id LIMIT ".LIMIT_VIEW_GAMES_INDEX_PAGE,
                                array('N' => LIMIT_VIEW_GAMES_INDEX_PAGE * ($data['pagin_numb'] - 1)),
                                $conn);

    }

    view('admin_games', $data, 'admin');
?>
