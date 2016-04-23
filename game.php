<?php
    require 'settings.php';

    //Connect to the DATA BASE
    $conn = connect($config);

    $data;

    if (!$conn)
        die("I can't connect DB! I'm sorry!");

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
        query_for_change("INSERT INTO comments(game_id, author_name, date, body) VALUES(:game_id, :author_name, :date, :body)",
              array('game_id' => $current_page, 'author_name' => $_POST['user'], 'date'=>date('Y-m-d H:i:s'), 'body'=>$_POST['body']),
              $conn);
    }


    $data['game'] = query("SELECT games.id as games_id, home_team_id, guest_team_id, home_scores, guest_scores, date, description,
                                team_home.name as home_team_name, 
                                team_guest.name as guest_team_name 
                        FROM (games INNER JOIN teams as team_home ON games.home_team_id = team_home.id 
                                    INNER JOIN teams as team_guest ON games.guest_team_id = team_guest.id) ",
                        array(),
                        $conn)[$current_page-1];

    $data['comments'] = query("SELECT * FROM comments WHERE game_id=:game_id ORDER BY date DESC",
                              array('game_id'=>$current_page) ,
                              $conn);
    
    view('game', $data);
