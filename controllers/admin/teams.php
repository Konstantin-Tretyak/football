<?php

namespace Controllers\Admin\Teams;

function create() {
    validate_authorized();
    validate_authorized_as_admin();

    $message_for_admin = message_for_admin();

    $data = null;

    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        validate_input($_POST, ['name']); 

        query_for_change("INSERT INTO teams(name) VALUES(:name)",
              array('name' => $_POST['name']),
              connect());

        flash_set('message', $message_for_admin['teams_new']);

        if(isset($_POST['page']))
        {
            return redirect($_POST['page']);
        }
    }

    return view('admin_teams_new', $data, 'admin');
}

function index() {
        validate_authorized();
        validate_authorized_as_admin();

    $data = null;
    $data['teams'] = query("SELECT * FROM teams ", array(), connect());
    return view('admin_teams' , $data, 'admin');
}

function edit() {
        validate_authorized();
        validate_authorized_as_admin();

    $data = null;
    $db = connect();

    $message_for_admin = message_for_admin();

    ///$current_page inicialization
    if ( isset($_GET['club_id']) )
    {
        $current_page = (int) $_GET['club_id'];
    }
    else
    {
        throw new NotFoundException();
    }
    ///end $current_page inicialization

    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $user_data = query("SELECT user_email, user.team_id as user_team_id, teams.id as teams_id, teams.name as user_teams_name
                            FROM user INNER JOIN teams ON user.team_id = teams.id
                            WHERE user.team_id=:user_team_id",
                           array('user_team_id'=>$current_page),
                           $db);

        query_for_change("UPDATE teams SET name=:name WHERE id=:id",
                          array('name' => $_POST['name'],
                          'id'=> $current_page),
                          $db);

        //wright_message($message_for_admin['teams_edit_name']);

        $data['team'] = query("SELECT * FROM teams WHERE id=:id",
                               array('id'=>$current_page),
                               $db)[0];

        //$message['teams_renamed'] = $user_data[0]['user_teams_name'].$message_for_user['teams_was_renamed'].$data['team']['name'];

        foreach ($user_data as $data)
        {
            $letter = create_Email_letter($data['user_email'], $message);
            send_Email($letter);
        }

        $_SESSION['message']=$message_for_admin['teams_edit_name'];

        if(isset($_POST['page']))
        {
            return redirect($_POST['page']);
        }
    }

    $data['team'] = query("SELECT * FROM teams WHERE id=:id",
                            array('id'=>$current_page),
                            $db)[0];


    $data['players'] = query("SELECT * FROM players WHERE  team_id=:team_id",
                             array('team_id'=> $current_page),
                             $db);

    return view('admin_teams_edit' , $data, 'admin');
}