<?php
namespace App\Repositories;

use Carbon\Carbon;
use App\Models\SportsBet;
use Illuminate\Support\Facades\Cache;

class SportsBetRepository
{
    /**
     * Returns a collection of bets where the provided user
     * has not made a pick, and the games do not have scores
     */
    public function getUnplacedBets($userId)
    {
        return Cache::rememberForever("bets.{$userId}.unplaced", function () use ($userId) {
            return SportsBet::with([
                    'game'
                ])
                ->where('user_id', $userId)
                ->whereNull('sports_team_id')
                ->whereHas('game', function ($query) {
                    return $query->whereNull('home_team_score')
                        ->whereNull('away_team_score')
                        ->where('starts_at', '>', Carbon::Now());
                })
                ->get();
        });
    }

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
    }
}
