<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Prophecy\Call\Call;

class Game extends Model
{
    protected $appends = ['week'];

    protected $casts = [
        'starts_at' => 'datetime',
        'spread' => 'float'
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

    public function findWeek()
    {
        return $this->season->starts_at->diffInWeeks($this->starts_at) + 1;
    }

    public function getHasScoresAttribute()
    {
        return !is_null($this->home_team_score) || !is_null($this->away_team_score);
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
        $scoreSpread = $this->spreadScore();
        $beatSpread = $this->beatSpread();
        $spreadPush = is_null($this->spread) ? false : $scoreSpread == $this->spread;

        if ($spreadPush) {
            return null;
        }

        if ($homeWonGame) {
            if ($homeHasSpread) {
                return $beatSpread ? $this->homeTeam : $this->awayTeam;
            } else {
                return $this->homeTeam;
            }
        } else {
            if ($awayHasSpread) {
                return $beatSpread ? $this->awayTeam : $this->homeTeam;
            } else {
                return $this->awayTeam;
            }
        }
    }

    public function scoreWinner()
    {
        $homeWonGame = $this->home_team_score > $this->away_team_score;
        return $homeWonGame
            ? $this->homeTeam
            : $this->awayTeam;
    }

    public function spreadScore()
    {
        return abs($this->home_team_score - $this->away_team_score);
    }

    public function beatSpread()
    {
        return is_null($this->spread) ? true : $this->spreadScore() > $this->spread;
    }

    public function season()
    {
        return $this->belongsTo('App\Season');
    }

    public function week()
    {
        return $this->belongsTo('App\Week');
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

    public function opponent($teamId)
    {
        return $teamId === $this->home_team_id
            ? $this->awayTeam
            : $this->homeTeam;
    }
}
