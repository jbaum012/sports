<?php

namespace App\Models;

use App\Models\User;
use App\Models\GameGroup;
use App\Models\SportsGame;
use App\Models\SportsTeam;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        return $this->belongsTo(SportsGame::class, 'sports_game_id');
    }

    public function group()
    {
        return $this->belongsTo(GameGroup::class, 'game_group_id');
    }

    public function team()
    {
        return $this->belongsTo(SportsTeam::class, 'sports_team_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
