<?php

namespace App\Models;

use App\Events\SportsGames\SportsGameCreated;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    protected $casts = [
        'starts_at' => 'datetime'
    ];

    protected $fillable = [
        'game_group_id',
        'home_team_id',
        'away_team_id',
        'home_team_spread',
        'away_team_spread',
        'home_team_score',
        'away_team_score',
        'starts_at'
    ];

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

        if (! $this->hasSpread()) {
            return $this->winner();
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
        if (!$this->hasScores() || !$this->hasSpread()) {
            return null;
        }

        return $this->calculateSpread($this->home_team_score, $this->away_team_score, $this->home_team_spread);
    }

    public function awayCovered() : ?bool
    {
        if (!$this->hasScores() || !$this->hasSpread()) {
            return null;
        }

        return $this->calculateSpread($this->away_team_score, $this->home_team_score, $this->away_team_spread);
    }

    private function calculateSpread(int $score, int $otherTeamScore, int $spread) : bool
    {
        return $score - $otherTeamScore + $spread > 0;
    }

    public function hasSpread() : bool
    {
        return !is_null($this->home_team_spread) && !is_null($this->away_team_spread);
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

    public function group() : BelongsTo
    {
        return $this->belongsTo(GameGroup::class, 'game_group_id');
    }

    public function homeTeam() : BelongsTo
    {
        return $this->belongsTo(SportsTeam::class, 'home_team_id');
    }

    public function awayTeam() : BelongsTo
    {
        return $this->belongsTo(SportsTeam::class, 'away_team_id');
    }

    public function bets() : HasMany
    {
        return $this->hasMany(SportsBet::class);
    }

    /**
     * Events
     */
    protected $dispatchesEvents = [
        'created' => SportsGameCreated::class,
    ];

    protected static function booted()
    {
        static::created(function (SportsGame $game) {
            Cache::forget("sports_team.{$game->home_team_id}.games");
            Cache::forget("sports_team.{$game->away_team_id}.games");
        });
        static::updated(function ($game) {
            Cache::forget("sports_team.{$game->home_team_id}.games");
            Cache::forget("sports_team.{$game->away_team_id}.games");
        });
    }
}
