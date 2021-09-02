<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $label
 */
class GameGroup extends Model
{
    use HasFactory;

    public function userBets()
    {
        return $this->bets->groupBy('user_id');
    }

    public function games() : HasMany
    {
        return $this->hasMany(Game::class);
    }

    public function bets() : HasMany
    {
        return $this->hasMany(SportsBet::class);
    }
}
