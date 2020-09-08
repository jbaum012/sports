<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

    public function gameForWeek($week)
    {
        return $this->games()->where('week_number', $week)->get();
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
        return $this->homeGames()->concat($this->awayGames);
    }

    public function wonGames()
    {
        return $this->hasMany('App\Game', 'winner');
    }

    public function bets()
    {
        return $this->hasMany('App\Bet');
    }
}
