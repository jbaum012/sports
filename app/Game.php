<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $appends = ['week'];

    protected $casts = [
        'starts_at' => 'datetime',
    ];

    public function allowNewBets()
    {
        return Carbon::now() < $this->starts_at;
    }

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

    public function spreadTeam()
    {
        return $this->belongsTo('App\Team', 'spread_team_id');
    }

    public function homeTeam()
    {
        return $this->belongsTo('App\Team', 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo('App\Team', 'away_team_id');
    }

    public function getUserBetAttribute()
    {
        return $this->bets()->where('user_id', Auth::id())->first();
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
