<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Monolog\Processor\HostnameProcessor;
use phpDocumentor\Reflection\Types\Boolean;

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

    public function winner() : ?SportsTeam
    {
        if (!$this->hasScores() || $this->isTie()) {
            return null;
        }

        return $this->home_team_score > $this->away_team_score
            ? $this->homeTeam
            : $this->awayTeam;
    }

    public function spreadWinner() : ?SportsTeam
    {
        if (! $this->hasScores()) {
            return null;
        }
        if ($this->isSplit()) {
            return null;
        }

        return $this->homeCovered()
            ? $this->homeTeam
            : $this->awayTeam;
    }

    public function isSplit() : ?bool
    {
        return !$this->homeCovered() && !$this->awayCovered();
    }


    public function homeCovered() : ?bool
    {
        if (!$this->hasScores()) {
            return null;
        }

        return $this->calculateSpread($this->home_team_score, $this->away_team_score, $this->home_team_spread);
    }

    public function awayCovered() : ?bool
    {
        if (!$this->hasScores()) {
            return null;
        }

        return $this->calculateSpread($this->away_team_score, $this->home_team_score, $this->away_team_spread);
    }

    private function calculateSpread(int $score, int $otherTeamScore, int $spread) : bool
    {
        return $score - $otherTeamScore + $spread > 0;
    }

    public function hasScores() : bool
    {
        return !is_null($this->home_team_score) && !is_null($this->away_team_score);
    }

    public function isTie() : ?bool
    {
        if (!$this->hasScores()) {
            return null;
        }
        return $this->home_team_score === $this->away_team_score;
    }

    /**
     * Relationships
     */

    public function group()
    {
        return $this->hasOne(GameGroup::class, 'id');
    }

    public function homeTeam() : HasOne
    {
        return $this->hasOne(SportsTeam::class, 'id');
    }

    public function awayTeam() : HasOne
    {
        return $this->hasOne(SportsTeam::class, 'id');
    }

    /**
     * Events
     */
    protected static function booted()
    {
        static::created(function (SportsGame $game) {
            Cache::forget("{$game->homeTeam->cacheKey()}.games");
            Cache::forget("{$game->awayTeam->cacheKey()}.games");
        });
        static::updated(function ($game) {
            Cache::forget("{$game->homeTeam->cacheKey()}.games");
            Cache::forget("{$game->awayTeam->cacheKey()}.games");
        });
    }
}
