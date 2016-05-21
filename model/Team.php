<?php

class Team extends DbModel
{
    protected static $table = 'teams';

    public function homeTeamName()
    {
        return($this->hasMany('Game', 'home_team_id', 'id'));
    }

    public function guestTeamName()
    {
        return($this->hasMany('Game', 'guest_team_id', 'id'));
    }
}