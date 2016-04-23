<?php
    require '../../settings.php';

    session_start();
    //Connect to the DATA BASE
    $conn = connect($config);

    $data = null;

    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if ( !isset($_POST['player_name']) )
        {
            echo "Введите имя игрока";
        }
        if ( !isset($_POST['players_team_id']) )
        {
            echo "Выберите клуб";
        }
        else
        {
        query_for_change("INSERT INTO players(team_id,name,position) VALUES(:team_id,:name,:position)",
                         array('team_id'=>$_POST['players_team_id'],'name' => $_POST['player_name'],'position'=>$_POST['player_position']),
                         $conn);

        $user_data = query("SELECT user_email, user.team_id as user_team_id, teams.id as teams_id, teams.name as user_teams_name
                            FROM user INNER JOIN teams ON user.team_id = teams.id
                            WHERE user.team_id=:user_team_id",
                           array('user_team_id'=>$_POST['players_team_id']),
                           $conn);

        $message['players_new'] = "В клубе ".$user_data[0]['user_teams_name'].$message_for_user['player_was_create'].$_POST['player_name'];

        foreach ($user_data as $data)
        {
            $letter = create_Email_letter($data['user_email'], $message);
            send_Email($letter);
        }

        $_SESSION['message']=$message_for_admin['players_new'];
        }
    }

    $data['teams'] = query("SELECT * FROM teams", array(), $conn);

    view('admin_players_new', $data, 'admin');
?>