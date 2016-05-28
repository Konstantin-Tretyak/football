<?php

class Team extends DbModel
{
    protected static $table = 'teams';

    // public function homeTeamName()
    // {
    //     return($this->hasMany('Game', 'home_team_id', 'id'));
    // }

    // public function guestTeamName()
    // {
    //     return($this->hasMany('Game', 'guest_team_id', 'id'));
    // }

    public function players()
    {
        return ($this->hasMany('Player', 'team_id', 'id'));
    }

    public function games()
    {
        return array_merge($this->games_as_guest()->all(), $this->games_as_home()->all());
    }

    public function games_as_home()
    {
        return ($this->hasMany('Game', 'home_team_id', 'id'));
    }

    public function games_as_guest()
    {
        return ($this->hasMany('Game', 'guest_team_id', 'id'));
    }  


}