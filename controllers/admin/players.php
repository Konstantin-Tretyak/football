<?php
    
    namespace Controllers\Admin\Players;

    function create()
    {
        validate_authorized();
        validate_authorized_as_admin();

        $message_for_admin = message_for_admin();

        $data = null;

        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            validate_input($_POST, ['player_name', 'players_team_id']); 

            \Player::create(['team_id'=>$_POST['players_team_id'],'name' => $_POST['player_name'],'position'=>$_POST['player_position']]);

            /*$user_data = query("SELECT user_email, user.team_id as user_team_id, teams.id as teams_id, teams.name as user_teams_name
                                FROM user INNER JOIN teams ON user.team_id = teams.id
                                WHERE user.team_id=:user_team_id",
                               array('user_team_id'=>$_POST['players_team_id']),
                               connect());

            if ( !empty($user_data) )
            {
                $message['players_new'] = "В клубе ".$user_data[0]['user_teams_name'].$message_for_user['player_was_create'].$_POST['player_name'];

                foreach ($user_data as $data)
                {
                    $letter = create_Email_letter($data['user_email'], $message);
                    send_Email($letter);
                }
            }*/

            flash_set('message', $message_for_admin['players_new']);
        }

        $data['teams'] = \Team::query()->all();

        foreach ($data['teams'] as $key => $value)
        {
            $data['teams'][$key] = $value->toArray();
        }

        return view('admin_players_new', $data, 'admin');
    }

    function edit()
    {
        validate_authorized();
        validate_authorized_as_admin();

        $data = null;

        ///$current_page inicialization
            if ( isset($_GET['player_id']) )
            {
                $current_page = (int) $_GET['player_id'];
            }
            else 
            {
                die("Нет страницы");
            }
        ///end $current_page inicialization


        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $player_temporary;

            $player_old = query("SELECT * FROM players WHERE id=:id",
                                 array('id'=>$current_page),
                                 connect())[0];

            ///Во избежание перезаписи существующих полей пустыми данными производим проверку $_POST
            ///и заполнение временного массива $player_temporary.
            /*foreach ($_POST as $key => $value)
            {
                $data['teams'] = \Team::query()->all();

                foreach ($data['teams'] as $key => $value)
                {
                    $data['teams'][$key] = $value->toArray();
                }

              if ( $value )
                {
                    $player_temporary[$key] = $value;

                    if ( !strnatcasecmp( $key , "name" ) )
                    {
                        $message[$key] = "Имя игрока было измененно с ".$player_old[$key]." на ".$player_temporary[$key];
                    }

                    if (!strnatcasecmp( $key , "position" ))
                    {
                        $message[$key] = "Позиция игрока была измененно с ".$player_old[$key]." на ".$player_temporary[$key];
                    }

                    if (!strnatcasecmp( $key , "team_id" ))
                    {
                        if ($player_old[$key] != $player_temporary[$key])
                        {
                            $message[$key] = "Клуб игрока ".$player_temporary['name']." был изменен с ".$data['teams'][ $player_old[$key]-1 ]['name']." на "
                                         .$data['teams'][ $player_temporary[$key]-1 ]['name'];
                        }
                    }
                }
                else
                {
                    $player_temporary[$key] = $player_old[$key];
                }
            }*/

            $data['player'] = \Player::query()->where('id=?', [$current_page])->all()[0]->toArray();

            query_for_change("UPDATE players SET name=:name, team_id=:team_id, position=:position WHERE id=:id",
                              array('name' => $player_temporary['name'],
                                    'team_id'=> $player_temporary['team_id'],
                                     'position'=> $player_temporary['position'],
                                     'id'=> $current_page),
                              connect());

            

            $user_data = query("SELECT user_email, user.team_id as user_team_id, teams.id as teams_id, teams.name as user_teams_name
                                FROM user INNER JOIN teams ON user.team_id = teams.id
                                WHERE user.team_id=:user_team_id_new OR user.team_id=:user_team_id_old",
                               array('user_team_id_new'=>$player_temporary['team_id'],
                                     'user_team_id_old'=>$player_old['team_id']),
                               connect());

            foreach ($user_data as $data)
            {
                $letter = create_Email_letter($data['user_email'], $message);
                send_Email($letter);
            }

            $_SESSION['message']=$message_for_admin['players_edit'];
        }


        $data['player'] = query("SELECT * FROM players WHERE id=:id",
                                array('id'=>$current_page),
                                connect())[0];

        $data['teams'] = query("SELECT * FROM teams", array(), connect());

        return view('admin_players_edit' , $data, 'admin');
    }