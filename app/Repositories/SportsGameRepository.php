<?php
namespace App\Repositories;

use App\Models\SportsGame;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\SportsGame as SportsGameResource;

class SportsGameRepository
{
    public function search(): Collection
    {
        return SportsGame::with('homeTeam')
            ->with('awayTeam')
            ->orderBy('game_group_id')
            ->orderBy('starts_at')
            ->get();
    }

    public function fullGamesList()
    {
        $cacheTime = 60 * 60 * 24;
        return Cache::remember('sports_games', $cacheTime, function () {
            $collection = SportsGameResource::collection($this->search());
            $groups = $collection->collection->groupBy('game_group_id');
            $reversed = array_reverse($groups->toArray());
            return $reversed;
        });
    }

    public function create(array $args): SportsGame
    {
        $game = new SportsGame();
        return $this->update($game, $args);
    }

    public function update(SportsGame $game, array $args): SportsGame
    {
        $game->game_group_id = $args['game_group_id'];
        $game->home_team_id = $args['home_team_id'];
        $game->away_team_id = $args['away_team_id'];
        $game->home_team_spread = $args['home_team_spread'] ?? null;
        $game->away_team_spread = $args['away_team_spread'] ?? null;
        $game->starts_at = $args['starts_at'];
        $game->save();

        return $game;
    }
}
