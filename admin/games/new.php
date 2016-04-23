<?php
    require '../../settings.php';

    session_start();
    //Connect to the DATA BASE
    $conn = connect($config);

    $data = null;
    $valide_data = true;

    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        foreach ($_POST as $key => $value)
        {
            /*///SHURIK - POSMOTRI
            if ( ($key!='home_scores') or ($key!='guest_scores') )
            ///END SHURIK - POSMOTRI*/
            //{
                if ($value == "")
                {
                    echo "Укажите ".$key;
                    $valide_data = false;
                }
            //}
        }

        if ($valide_data)
        {
            query_for_change("INSERT INTO games(home_team_id,guest_team_id,home_scores,guest_scores,date) 
                              VALUES(:home_team_id,:guest_team_id,:home_scores,:guest_scores,:date)",
                             array('home_team_id'=>$_POST['home_team_id'],'guest_team_id'=>$_POST['guest_team_id'],
                                    'home_scores'=>$_POST['home_scores'],'guest_scores'=>$_POST['guest_scores'],
                                    'date'=>$_POST['date']),
                             $conn);

            /*$data['teams'] = query("SELECT * FROM teams", array(), $conn);

            $user_data = query("SELECT user_email, user.team_id as user_team_id, teams.id as teams_id, teams.name as user_teams_name
                                FROM user INNER JOIN teams ON user.team_id = teams.id
                                WHERE teams.id=:home_team_id OR teams.id=:guest_team_id",
                                array('home_team_id'=>$_POST['home_team_id'], 'guest_team_id'=>$_POST['guest_team_id']),
                                $conn);

            $message['game_new'] = "Игра ".$data['teams'][$_POST['home_team_id']-1]['name']." - ".$data['teams'][$_POST['guest_team_id']-1]['name'];

            foreach ($user_data as $data)
            {
                $letter = create_Email_letter($data['user_email'], $message);
                send_Email($letter);
            }*/

            $_SESSION['message']=$message_for_admin['games_new'];

            if(isset($_POST['page']))
            {
                header("Location: {$_POST['page']}");
                exit();
            }
        }
    }

    $data['teams'] = query("SELECT * FROM teams", array(), $conn);

    view('admin_games_new', $data, 'admin');
?>