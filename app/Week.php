<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    protected $casts = [
        'starts' => 'date',
    ];

    public function isCurrentWeek()
    {
        return Season::find(env('BETTING_SEASON', 1))->currentWeek() === $this->starts;
    }

    public function games()
    {
        return $this->hasMany('App\Game');
    }

    public function bets()
    {
        return $this->hasMany('App\Bet');
    }
}
