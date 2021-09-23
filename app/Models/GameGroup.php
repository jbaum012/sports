<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $label
 */
class GameGroup extends Model
{
    use HasFactory;

    public function hasPendingOrPlayedGames(): bool
    {
        return $this->games->some(function ($game) {
            return $game->starts_at < Carbon::Now();
        });
    }

    public function userBets()
    {
        return $this->bets->groupBy('user_id');
    }

    public function games() : HasMany
    {
        return $this->hasMany(SportsGame::class);
    }

    public function bets() : HasMany
    {
        return $this->hasMany(SportsBet::class);
    }
}
