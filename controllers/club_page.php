<?php
    namespace Controllers\UserPages;

    function club_page()
    {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == strtolower('xmlhttprequest'))
        {
            return subscribe_team();
        }

        define('LIMIT_PAGE', 5);

        // TODO: не просто проверять isset , а наличие такого club_id в БД
        if ( isset($_GET['club_id']) && is_numeric($_GET['club_id']) )
        {
            $id = $_GET['club_id'];
        }
        else
        {
            throw new NotFoundException();
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
        
        $team = \Team::find($id);
        $query = $team->games()->order_by('date', 'up');
        $total_count = $query->count();

        $pagination = new \Pagination(LIMIT_PAGE, $total_count, $page);

        if ($page > $pagination->pages_quantity()) {
            return redirect(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
        }

        $games = $query->offset(LIMIT_PAGE * ($page - 1),LIMIT_PAGE)->all();

        return view('club_page', compact('team', 'games', 'pagination'));
    }
