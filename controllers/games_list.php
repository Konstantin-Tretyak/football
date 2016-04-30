<?php
    $data;

    $data['games'] = query("SELECT * FROM games", array(), $conn);

    ///Work with DB content
        ///$pagin_numb inicialization
            if ( isset($_GET['N']) )
            {
                if ( is_numeric($_GET['N']) )
                    $data['pagin_numb'] = (int) $_GET['N'];
                else
                    throw new NotFoundException();
            }
            else
            {
                    $data['pagin_numb'] = 1;
            }
        ///end $pagin_numb inicialization

        ///Take DB content
            $data['last_games'] = query("SELECT games.id as games_id, home_team_id, guest_team_id, home_scores, guest_scores, date,
                                                team_home.name as home_team_name,
                                                team_guest.name as guest_team_name
                                        FROM (games INNER JOIN teams as team_home ON games.home_team_id = team_home.id
                                                    INNER JOIN teams as team_guest ON games.guest_team_id = team_guest.id)
                                        WHERE games.id>:N  ORDER BY games.id LIMIT ".LIMIT_VIEW_GAMES_INDEX_PAGE,
                                        array('N' => LIMIT_VIEW_GAMES_INDEX_PAGE * ($data['pagin_numb'] - 1)),
                                        $conn);

            $data['club_name'] = query("SELECT * FROM teams", array(), $conn);
        ///Take DB content

        /*$jmsv= json_encode($data['club_name']);

        creat_JSON_file($jmsv, "teams.json");*/
    ///End work with DB content

    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        query_for_change("INSERT INTO user(user_email, team_id)
                          VALUES(:user_email, :team_id)",
                          array('user_email'=>$_POST['user_email'], 'team_id'=>$_POST['user_liked_team_id']),
                          $conn);

        $user_data = query("SELECT user_email, user.team_id as user_team_id, teams.id as teams_id, teams.name as user_teams_name
                            FROM user INNER JOIN teams ON user.team_id = teams.id
                            WHERE user_email = :user_email AND user.team_id=:user_team_id",
                           array('user_email'=>$_POST['user_email'], 'user_team_id'=>$_POST['user_liked_team_id']),
                           $conn)[0];

        $letter = "Hello, ".$user_data['user_email']."!!! ".$message_for_user['teams_was_add_to_user_liked'].$user_data['user_teams_name'];

        $letter = create_Email_letter($user_data['user_email'], $letter);

        send_Email($letter);

        $_SESSION['message']= $message_for_user['teams_add_to_user_liked'].$user_data['user_teams_name'];

    }

    view('games_list', $data);
