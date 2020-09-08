<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public function getWeekAttribute()
    {
        return $this->season->starts_at->diffInWeeks($this->starts_at) + 1;
    }

    public function season()
    {
        return $this->belongsTo('App\Season');
    }

    public function bets()
    {
        return $this->hasMany('App\Bet');
    }

    public function homeTeam()
    {
        return $this->belongsTo('App\Team', 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo('App\Team', 'away_team_id');
    }

    public function getWinnerAttribute()
    {
        if ($this->home_team_score === null || $this->away_team_score === null) {
            return null;
        }

        if ($this->home_team_score === $this->away_team_score) {
            return null;
        }

        return $this->home_team_score > $this->away_team_score
            ? $this->homeTeam
            : $this->awayTeam;
    }
}
