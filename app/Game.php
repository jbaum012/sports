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

    public function betsForHome()
    {
        return $this->bets->where('team_id', $this->home_team_id);
    }

    public function betsForAway()
    {
        return $this->bets->where('team_id', $this->away_team_id);
    }

    public function getUserBetAttribute()
    {
        return $this->bets()->where('user_id', Auth::id())->first();
    }

    public function getWeekAttribute()
    {
        return $this->season->starts_at->diffInWeeks($this->starts_at) + 1;
    }

    public function getWinnerAttribute()
    {
        if (is_null($this->home_team_score) || is_null($this->away_team_score)) {
            return null;
        }

        if ($this->home_team_score === $this->away_team_score) {
            return null;
        }

        $homeWonGame = $this->home_team_score > $this->away_team_score;

        if (is_null($this->spread) || is_null($this->spread_team_id)) {
            return $homeWonGame
                ? $this->homeTeam
                : $this->awayTeam;
        }

        $homeHasSpread = $this->spread_team_id === $this->home_team_id;
        $awayHasSpread = $this->spread_team_id === $this->away_team_id;
        $scoreSpread = abs($this->home_team_score - $this->away_team_score);
        $beatSpread = $scoreSpread > $this->spread;

        if ($homeWonGame) {
            if ($homeHasSpread && $beatSpread) {
                return $this->homeTeam;
            } else {
                return $this->awayTeam;
            }
        } else {
            if ($awayHasSpread && $beatSpread) {
                return $this->awayTeam;
            } else {
                return $this->homeTeam;
            }
        }
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
}
