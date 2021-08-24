<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

class SportsBet extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_group_id',
        'sports_game_id',
        'sports_team_id',
        'user_id',
        'doubled'
    ];

    const BASE_VALUE = 2;

    public function won(): ?Boolean
    {
        $winningTeam = $this->game->winner();
        if (is_null($winningTeam)) {
            return null;
        }

        return $winningTeam === $this->team;
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function group()
    {
        return $this->belongsTo(GameGroup::class);
    }

    public function team()
    {
        return $this->belongsTo(SportsTeam::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
