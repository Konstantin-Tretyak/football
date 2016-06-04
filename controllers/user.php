<?php

    namespace Controllers\User;
    
    function show()
    {
        validate_authorized();

        define('LIMIT_PAGE', 5);

        $team_query = get_auth_user()->teams();

        $total_count = $team_query->count();
        $pagination = new \Pagination(LIMIT_PAGE, $total_count);

        $user_teams = $team_query->offset(LIMIT_PAGE * ($pagination->page - 1),LIMIT_PAGE)->all();

        return view('user', compact('user_teams','pagination'));
    }
