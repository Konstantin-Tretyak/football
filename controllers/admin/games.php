<?php

    namespace Controllers\Admin\Games;

    function create()
    {
        validate_authorized();
        validate_authorized_as_admin();

        $teams = \Team::query()->all();
        return view('admin_games_new', compact('teams'), 'admin');
    }

    function create_entity()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            validate_input($_POST, ['home_team_id', 'guest_team_id', 'date']);

            \Game::create(['home_team_id'=>$_POST['home_team_id'],'guest_team_id'=>$_POST['guest_team_id'],
                           'home_scores'=>$_POST['home_scores'],'guest_scores'=>$_POST['guest_scores'],
                           'date'=>$_POST['date']]);

            $message_for_admin = message_for_admin();
            flash_set('message', $message_for_admin['games_new']);

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
        define('LIMIT_PAGE', 10);

        $page = 1;
        if (isset($_GET['N'])) {
            if (is_numeric($_GET['N'])) {
                $page = $_GET['N'];
            }
            else {
                return redirect(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
            }
        }
        
        $query = \Game::query()->order_by('date', 'up');
        $total_count = $query->count();

        $pagination = new \Pagination(LIMIT_PAGE, $total_count, $page);

        if ($page > $pagination->pages_quantity()) {
            return redirect(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
        }

        $games = $query->offset(LIMIT_PAGE * ($page - 1),LIMIT_PAGE)->all();

        return view('admin_games', compact('games', 'pagination'), 'admin');
    }

    function edit()
    {
        validate_authorized();
        validate_authorized_as_admin();

        if ( isset($_GET['game']) )
        {
            $id = (int) $_GET['game'];
        }
        else 
        {
            throw new NotFoundException();
        }

        if (!($game = \Game::find($id))) {
            throw new \NotFoundException();
        }        

        return view('admin_games_edit' , compact('game'), 'admin');
    }

    function edit_entity()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            if ( isset($_GET['game']) )
            {
                $id = (int) $_GET['game'];
            }
            else 
            {
                throw new NotFoundException();
            }

            if (!($game = \Game::find($id))) {
                throw new \NotFoundException();
            }           
                     
            $game->update(['home_scores'=>$_POST['home_scores'], 'guest_scores'=>$_POST['guest_scores'],
                           'date'=>$_POST['date'], 'description'=>$_POST['description']]);

            $message_for_admin = message_for_admin(); 
            $_SESSION['message']=$message_for_admin['games_edit'];

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