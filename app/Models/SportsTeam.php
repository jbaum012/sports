<?php

namespace App\Models;

use App\Models\SportsGame;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $location
 * @property string $abbreviation
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

    public function fullName()
    {
        return $this->location . ' ' . $this->name;
    }

    /**
     *  Relationships
     */

    public function homeGames()
    {
        return $this->hasMany(SportsGame::class, 'home_team_id');
    }

    public function awayGames()
    {
        return $this->hasMany(SportsGame::class, 'away_team_id');
    }

    public function games()
    {
        return SportsGame::where('away_team_id', $this->id)
            ->where('home_team_id', $this->id)
            ->get();
        // TODO: do this caching
        // $key = 'sports_team.'.$this->id.'.games';
        // return Cache::remember(
        //     $key,
        //     60 * 10, // 10 minutes
        //     fn () => SportsGame::where('away_team_id', $this->id)
        //         ->where('home_team_id', $this->id)
        //         ->get()
        // );
    }
}
