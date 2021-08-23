<?php
namespace App\Repositories;

use App\Models\SportsGame;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

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

        Cache::forget('sports_games');
        return $game;
    }
}
