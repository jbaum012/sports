<?php

namespace App\Models;

use App\Models\User;
use App\Models\GameGroup;
use App\Models\SportsGame;
use App\Models\SportsTeam;
use Illuminate\Support\Facades\Auth;
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

    const BASE_VALUE = 2.0;
    const CREATOR_BONUS = 0.1;

    public function points(): ?float
    {
        if (is_null($this->won())) {
            return null;
        }
        $base = $this->won() === true
            ? self::BASE_VALUE
            : -self::BASE_VALUE;
        $authUser = Auth::check()
            ? Auth::user()->id
            : 0;
        $bonus = $this->user_id === $authUser
            ? self::CREATOR_BONUS
            : 0;
        return $base + $bonus;
    }

    public function won(): ?bool
    {
        $winningTeam = $this->game->winner();
        if (is_null($winningTeam)) {
            return null;
        }

        return $winningTeam->id == $this->sports_team_id;
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

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
