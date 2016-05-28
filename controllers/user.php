<?php

    namespace Controllers\UserPages;
    
    function user_page()
    {
        validate_authorized();

        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == strtolower('xmlhttprequest'))
        {
            return subscribe_team();
        }

        $data = null;
        define('LIMIT_PAGE', 5);

        $data['user'] = get_authorized_user()['login'];

        $user_id = \User::query()->where("login=?",[get_authorized_user()['login']])->first()->id;
        $user_teams_id = \UserTeam::query()->where("user_id=?",[$user_id])->all();

        $team_query = \Team::query();

        foreach ($user_teams_id as $user_team_id)
        {
            // $binding[] = $user_team_id->team_id;
            // $team_query = $team_query->or_where("id=?", $binding);
            $team_query = $team_query->or_where("id=?", [$user_team_id->team_id]);

        }

        $total_count = $team_query->count();
        $data['pagination'] = new \Pagination(LIMIT_PAGE, $total_count);

        $user_teams = $team_query->offset(LIMIT_PAGE * ($data['pagination']->page - 1),LIMIT_PAGE)->
                                   all();

        foreach ($user_teams as $user_team)
        {
            $data['user_teams'][] = $user_team->toArray();
        }

        $query_team = \Team::query()->where("name=?",[$data['user']]);
        $data['teams'] = $query_team->all();

        ///Взятие игр и имен комманд из БД
        //$data['teams'] = \Team::query()->

        return view('user', $data);
    }
