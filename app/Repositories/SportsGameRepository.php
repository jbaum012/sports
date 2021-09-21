<?php
namespace App\Repositories;

use App\Models\SportsGame;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\SportsGame as SportsGameResource;
use Carbon\Carbon;

class SportsGameRepository
{
    private function searchQuery()
    {
        return SportsGame::with('homeTeam')
            ->with('awayTeam')
            ->orderBy('game_group_id')
            ->orderBy('starts_at');
    }

    public function search(): Collection
    {
        return $this->searchQuery()->get();
    }

    public function fullGamesList(): array
    {
        $cacheTime = 60 * 60 * 24;
        return Cache::remember('sports_games', $cacheTime, function () {
            $collection = SportsGameResource::collection($this->search());
            $groups = $collection->collection->groupBy('game_group_id');
            $reversed = array_reverse($groups->toArray());
            return $reversed;
        });
    }

    public function pendingGames(): array
    {
        $games = $this->searchQuery()
            ->where('starts_at', '<=', Carbon::now())
            ->whereNull('home_team_score')
            ->whereNull('away_team_score')
            ->get();
        $collection = SportsGameResource::collection($games);
        $groups = $collection->collection->groupBy('game_group_id');
        $reversed = array_reverse($groups->toArray());
        return $reversed;
    }

    public function create(array $args): SportsGame
    {
        $game = new SportsGame();
        $game->created_by = Auth::user()->id;
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
