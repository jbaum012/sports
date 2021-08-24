<?php
namespace App\Repositories;

use App\Models\SportsBet;

class SportsBetRepository
{
    public function create(array $args): SportsBet
    {
        $bet = new SportsBet();
        return $this->update($bet, $args);
    }

    public function update(SportsBet $bet, array $args): SportsBet
    {
        $bet->game_group_id = $args['game_group_id'];
        $bet->sports_game_id = $args['sports_game_id'];
        $bet->sports_team_id = $args['sports_team_id'] ?? null;
        $bet->user_id = $args['user_id'];
        $bet->doubled = $args['doubled'] ?? false;
        $bet->save();

        return $bet;
        // $game->game_group_id = $args['game_group_id'];
        // $game->home_team_id = $args['home_team_id'];
        // $game->away_team_id = $args['away_team_id'];
        // $game->home_team_spread = $args['home_team_spread'] ?? null;
        // $game->away_team_spread = $args['away_team_spread'] ?? null;
        // $game->starts_at = $args['starts_at'];
        // $game->save();

        // Cache::forget('sports_games');
        // return $game;
    }
}
