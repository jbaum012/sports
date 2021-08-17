<?php

namespace App\Models;

use App\Models\SportsGame;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $name
 * @property string $location
 * @property string $abbreviation
 * @property string $division
 * @property string $primary_color
 * @property string $secondary_color
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Collection|SportsGame[] homeGames
 * @property Collection|SportsGame[] awayGames
 * @property Collection|SportsGame[] games
 */
class SportsTeam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'abbreviation',
        'division',
        'primary_color',
        'secondary_color'
    ];

    public function slug()
    {
        return Str::slug($this->name, '-');
    }

    public function cacheKey()
    {
        return "sports_team.{$this->id}";
    }

    public function homeGames()
    {
        return $this->hasMany(SportsGames::class, 'home_team_id');
    }

    public function awayGames()
    {
        return $this->hasMany(SportsGames::class, 'away_team_id');
    }

    public function games()
    {
        $key = "{$this->cacheKey()}.games";
        $cacheTime = 60 * 100; // 60 minutes
        return Cache::remember($key, $cacheTime, function () {
            return SportsGame::where('home_team_id', $this->id)
                ->orwhere('away_team_id', $this->id)
                ->get();
        });
    }
}
