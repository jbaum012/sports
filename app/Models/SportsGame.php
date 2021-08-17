<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property int $game_group_id
 * @property int $home_team_id
 * @property int $away_team_id
 * @property double|null $home_team_spread
 * @property double|null $away_team_spread
 * @property int|null $home_team_score
 * @property int|null $away_team_score
 * @property Carbon $starts_at
 * @property SportsTeam $homeTeam
 * @property SportsTeam $awayTeam
 */
class SportsGame extends Model
{
    use HasFactory;

    /**
     * Relationships
     */

    public function group()
    {
        return $this->hasOne(GameGroup::class, 'game_group_id');
    }

    public function homeTeam()
    {
        return $this->hasOne(SportsTeam::class, 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->hasOne(SportsTeam::class, 'away_team_id');
    }

    /**
     * Events
     */
    protected static function booted()
    {
        static::created(function ($game) {
            Cache::forget("{$game->homeTeam->getCacheKey()}.games");
            Cache::forget("{$game->awayTeam->getCacheKey()}.games");
        });
        static::updated(function ($game) {
            Cache::forget("{$game->homeTeam->getCacheKey()}.games");
            Cache::forget("{$game->awayTeam->getCacheKey()}.games");
        });
    }
}
