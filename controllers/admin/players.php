<?php
    
    namespace Controllers\Admin\Players;

    function create()
    {
        validate_authorized();
        validate_authorized_as_admin();

        $message_for_admin = message_for_admin();

        $teams = \Team::query()->all();
        return view('admin_players_new', compact('teams'), 'admin');
    }

    function create_entity()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            validate_input($_POST, ['player_name', 'players_team_id']); 

            \Player::create(['team_id'=>$_POST['players_team_id'],'name' => $_POST['player_name'],'position'=>$_POST['player_position']]);

            $message_for_admin = message_for_admin();
            flash_set('message', $message_for_admin['players_new']);
            return redirect_back();
        }
    }

    function edit()
    {
        validate_authorized();
        validate_authorized_as_admin();

        if ( isset($_GET['player_id']) )
        {
            $id = (int) $_GET['player_id'];
        }
        else 
        {
            throw new NotFoundException();
        }

        if (!($player = \Player::find($id))) {
            throw new \NotFoundException();
        }                    
        $teams = \Team::query()->all();

        return view('admin_players_edit', compact('player', 'teams'), 'admin');
    }

    function edit_entity()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            if ( isset($_GET['player_id']) )
            {
                $id = (int) $_GET['player_id'];
            }
            else 
            {
                throw new NotFoundException();
            }

            if (!($player = \Player::find($id))) {
                throw new \NotFoundException();
            }                    
           
            validate_input($_POST, ['name', 'team_id', 'position']);

            $player->update(array('name' => $_POST['name'], 'team_id'=> $_POST['team_id'], 'position'=> $_POST['position']));

            $message_for_admin = message_for_admin();
            flash_set('message', $message_for_admin['teams_edit_name']);
            return redirect_back();
        }
    }