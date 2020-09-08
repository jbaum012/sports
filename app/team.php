<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function gamesForWeek($week)
    {
        return $this->games()->where('week', $week);
    }

    public function season()
    {
        return $this->belongsTo('App\Season');
    }

    public function homeGames()
    {
        return $this->hasMany('App\Game', 'home_team_id');
    }

    public function awayGames()
    {
        return $this->hasMany('App\Game', 'away_team_id');
    }

    public function games()
    {
        return $this->homeGames->concat($this->awayGames)->sortBy('week');
    }

    public function bets()
    {
        return $this->hasMany('App\Bet');
    }
}
