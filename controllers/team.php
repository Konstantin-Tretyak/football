<?php
    namespace Controllers\Team;

    function show()
    {
        define('LIMIT_PAGE', 5);

        if ( isset($_GET['club_id']) && is_numeric($_GET['club_id']) )
        {
            $id = $_GET['club_id'];
        }
        else
        {
            throw new \NotFoundException();
        }

        $page = 1;
        if (isset($_GET['N'])) {
            if (is_numeric($_GET['N'])) {
                $page = $_GET['N'];
            }
            else {
                return redirect(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
            }
        }
        
        if (!($team = \Team::find($id))) {
            throw new \NotFoundException();
        }

        $query = $team->games()->order_by('date', 'up');
        $total_count = $query->count();

        $pagination = new \Pagination(LIMIT_PAGE, $total_count, $page);

        if ($page > $pagination->pages_quantity()) {
            return redirect(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
        }

        $games = $query->offset(LIMIT_PAGE * ($page - 1),LIMIT_PAGE)->all();

        return view('club_page', compact('team', 'games', 'pagination'));
    }

    function subscribe()
    {   
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == strtolower('xmlhttprequest'))
        {
            validate_authorized();

            if( $_POST['status'] == "delete" )
            {
                \UserTeam::delete('team_id', $_POST['team_id']);
                return json_encode(['status'=>'deleted']);
            }
            else
            {
                $user_team = \UserTeam::create(['team_id' => $_POST['team_id'], 'user_id' => get_authorized_user()['id']]);
                return json_encode($user_team->toArray());
            }
        }
    }    
