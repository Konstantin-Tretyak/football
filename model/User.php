<?php
class User extends DbModel
{
    protected static $table = 'user';

    public function teams()
    {
        return $this->hasManyThrough('Team', 'UserTeam', 'team_id', 'user_id');
    }

    public function is_subscribed_to_team($team_id)
    {
    	$teamClass = 'Team';
    	$teamTable = $teamClass::getTableName();    	

		$team = $this->teams()->where("$teamTable.id = ?",[$team_id])->first();
		return $team ? true : false;
    }
}