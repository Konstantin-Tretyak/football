<?php
    $data = null;

    ///$current_page inicialization
    if ( isset($_GET['club_id']) )
    {
        $current_page = (int) $_GET['club_id'];
    }
    else 
    {
        die("Нет страницы");
    }
    ///end $current_page inicialization

    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $user_data = query("SELECT user_email, user.team_id as user_team_id, teams.id as teams_id, teams.name as user_teams_name
                            FROM user INNER JOIN teams ON user.team_id = teams.id
                            WHERE user.team_id=:user_team_id",
                           array('user_team_id'=>$current_page),
                           $conn);

        query_for_change("UPDATE teams SET name=:name WHERE id=:id",
                          array('name' => $_POST['name'],
                          'id'=> $current_page),
                          $conn);

        //wright_message($message_for_admin['teams_edit_name']);

        $data['team'] = query("SELECT * FROM teams WHERE id=:id",
                               array('id'=>$current_page),
                               $conn)[0];

        $message['teams_renamed'] = $user_data[0]['user_teams_name'].$message_for_user['teams_was_renamed'].$data['team']['name'];

        foreach ($user_data as $data)
        {
            $letter = create_Email_letter($data['user_email'], $message);
            send_Email($letter);
        }

        $_SESSION['message']=$message_for_admin['teams_edit_name'];
 
        if(isset($_POST['page']))
        {
            header("Location: {$_POST['page']}");
            exit();
        }
    }

    $data['team'] = query("SELECT * FROM teams WHERE id=:id",
                            array('id'=>$current_page),
                            $conn)[0];


    $data['players'] = query("SELECT * FROM players WHERE  team_id=:team_id",
                             array('team_id'=> $current_page),
                             $conn);
    // session_destroy();

    view('admin_teams_edit' , $data, 'admin');