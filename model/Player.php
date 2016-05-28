<?php
class Player extends DbModel
{
    protected static $table = 'players';

    public function team()
    {
        return ($this->belongsTo('Team', 'team_id', 'id'));
    }    
}