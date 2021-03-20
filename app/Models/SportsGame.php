<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $game_group_id
 * @property int $home_team_id
 * @property int $away_team_id
 * @property int $spread_team_id
 * @property int|null $home_team_score
 * @property int|null $away_team_score
 * @property float|null $spread
 * @property Carbon $starts_at
 * @property Team $_at
 */
class SportsGame extends Model
{
    use HasFactory;

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
}
