<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PDO;

class Bet extends Model
{
    protected $casts = [
        'double_down' => 'boolean'
    ];

    public function getWonAttribute()
    {
        return is_null($this->game->winner)
            ? null
            : $this->game->winner == $this->team;
        // return $this->game->winner === $this->team;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function game()
    {
        return $this->belongsTo('App\Game');
    }

    public function team()
    {
        return $this->belongsTo('App\Team');
    }
}
