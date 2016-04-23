<?php
    
    require '../../settings.php';

    session_start();
    //Connect to the DATA BASE
    $conn = connect($config);

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

        $game_old = query("SELECT * FROM games WHERE id=:id",
                             array('id'=>$current_page),
                             $conn)[0];

        ///Во избежание перезаписи существующих полей пустыми данными производим проверку $_POST
        ///и заполнение временного массива $player_temporary.
        foreach ($_POST as $key => $value)
        {
           if ( $value != "" )
            {
                if (strnatcasecmp($key, "home_scores") || strnatcasecmp($key, "guest_scores"))
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

        $a = query_for_change("UPDATE games SET home_scores=:home_scores, guest_scores=:guest_scores, 
                                             date=:date, description=:description 
                          WHERE id=:id",
                          array('home_scores'=>$game_temporary['home_scores'], 'guest_scores'=>$game_temporary['guest_scores'],
                                'date'=>$game_temporary['date'], 'description'=>$game_temporary['description'],
                                'id'=>$current_page),
                          $conn);

        $_SESSION['message']=$message_for_admin['games_edit'];


        if(isset($_POST['page']))
        {
            header("Location: {$_POST['page']}");
            exit();
        }
    }


    $data['game'] = query("SELECT games.id as games_id, home_team_id, guest_team_id, home_scores, guest_scores, date,
                                        team_home.name as home_team_name, 
                                        team_guest.name as guest_team_name 
                                FROM (games INNER JOIN teams as team_home ON games.home_team_id = team_home.id 
                                            INNER JOIN teams as team_guest ON games.guest_team_id = team_guest.id) 
                                WHERE games.id=:id",
                                array('id' => $current_page),
                                $conn)[0];

    view('admin_games_edit' , $data, 'admin');