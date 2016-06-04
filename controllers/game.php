<?php
    
    namespace Controllers\Game;

    function show()
    {
        if ( isset($_GET['game']) && is_numeric($_GET['game']) )
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
        $comments = \Comment::query()->where('game_id = ?', [$id])->order_by("date", "up")->all();
        
        return view('game', compact('game', 'comments'));
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

        if ($page > $pagination->pages_quantity())
        {
            return redirect(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
        }

        $games = $query->offset(LIMIT_PAGE * ($page - 1),LIMIT_PAGE)->all();

        return view('games_list', compact('games', 'pagination'));
    }