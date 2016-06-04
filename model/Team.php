<?php

class Team extends DbModel
{
    protected static $table = 'teams';

    public function players()
    {
        return ($this->hasMany('Player', 'team_id', 'id'));
    }

    public function games()
    {
        $slaveClass = 'Game';
        $localKey = 'id';

        $localTable = self::getTableName();
        $slaveTable = $slaveClass::getTableName();

        $query = new QueryBuilder(self::$conn, [$slaveTable => '*'], $slaveClass);
        return $query->where("home_team_id = ? OR guest_team_id = ? ", [$this->{$localKey}, $this->{$localKey}]);
    }

    public function games_as_home()
    {
        return ($this->hasMany('Game', 'home_team_id', 'id'));
    }

    public function games_as_guest()
    {
        return ($this->hasMany('Game', 'guest_team_id', 'id'));
    }  

    public function users_subscribed()
    {
        return $this->hasManyThrough('User', 'UserTeam', 'user_id', 'team_id');
    }

}