<?php

class Game extends DbModel
{
    protected static $table = 'games';

    public function home_team()
    {
        return($this->hasMany('Team', 'id', 'home_team_id'));
    }

    public function guest_team()
    {
        return($this->hasMany('Team', 'id', 'guest_team_id'));
    }


}