<?php

namespace Controllers\Admin\Teams;

function create()
{
    validate_authorized();
    validate_authorized_as_admin();

    return view('admin_teams_new', null, 'admin');
}

function create_entity()
{
    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        validate_input($_POST, ['name']); 
        \Team::create(array('name' => $_POST['name']));

        $message_for_admin = message_for_admin();
        flash_set('message', $message_for_admin['teams_new']);

        if(isset($_POST['page']))
        {
            return redirect($_POST['page']);
        }
        else
        {
            return redirect_back();
        }
    }
}

function index()
{
    validate_authorized();
    validate_authorized_as_admin();

    return view('admin_teams', null, 'admin');
}

function edit()
{
    validate_authorized();
    validate_authorized_as_admin();

    $message_for_admin = message_for_admin();

    if ( isset($_GET['club_id']) )
    {
        $id = (int) $_GET['club_id'];
    }
    else
    {
        throw new NotFoundException();
    }

    if (!($team = \Team::find($id))) {
        throw new \NotFoundException();
    }            

    return view('admin_teams_edit' , compact('team'), 'admin');
}

function edit_entity()
{
    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if ( isset($_GET['club_id']) )
        {
            $id = (int) $_GET['club_id'];
        }
        else
        {
            throw new NotFoundException();
        }

        if (!($team = \Team::find($id))) {
            throw new \NotFoundException();
        }                    
       
        validate_input($_POST, ['name']);
        $team->update(array('name' => $_POST['name']));
            
        $message_for_admin = message_for_admin();
        flash_set('message', $message_for_admin['teams_edit_name']);
        return redirect_back();
    }
}