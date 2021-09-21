<?php
namespace App\Repositories;

use Carbon\Carbon;
use App\Models\SportsBet;
use App\Http\Resources\BetForGame;
use Illuminate\Support\Facades\Cache;
use App\Exceptions\DuplicateBetException;
use App\Exceptions\DoubleDownLimitReachedException;
use App\Http\Resources\SportsBet as SportsBetResource;

class SportsBetRepository
{
    public function getBetsForGame(int $gameId)
    {
        $bets = SportsBet::with('user')
            ->with('team')
            ->where('sports_game_id', $gameId)
            ->get();
        return BetForGame::collection($bets);
    }

    public function userDoubledForGroup(int $userId, int $gameGroupId)
    {
        return SportsBet::where('user_id', $userId)
            ->where('game_group_id', $gameGroupId)
            ->where('doubled', true)
            ->count();
    }

    public function resultsForUser(int $userId)
    {
        $cacheTime = 60 * 60 * 24;
        return Cache::remember("bets.{$userId}.results", $cacheTime, function () use ($userId) {
            $bets = SportsBet::with([
                    'game'
                ])
                ->where('user_id', $userId)
                ->whereHas('game', function ($query) {
                    return $query->whereNotNull('home_team_score')
                        ->whereNotNull('away_team_score');
                })
                ->get();
            $collection = SportsBetResource::collection($bets);
            $groups = $collection->collection->groupBy('game_group_id');
            $reversed = array_reverse($groups->toArray());
            return $reversed;
        });
    }

    public function betsForUser(int $userId)
    {
        $cacheTime = 60 * 60 * 24;
        return Cache::remember("bets.{$userId}", $cacheTime, function () use ($userId) {
            $bets = SportsBet::with([
                    'game'
                ])
                ->where('user_id', $userId)
                ->whereHas('game', function ($query) {
                    return $query->whereNull('home_team_score')
                        ->whereNull('away_team_score')
                        ->where('starts_at', '>', Carbon::Now());
                })
                ->get();
            $collection = SportsBetResource::collection($bets);
            $groups = $collection->collection->groupBy('game_group_id');
            $reversed = array_reverse($groups->toArray());
            return $reversed;
        });
    }

    public function findByUserAndGame(int $userId, int $gameId): ?SportsBet
    {
        return SportsBet::where('user_id', $userId)
            ->where('sports_game_id', $gameId)
            ->first();
    }

    /**
     * Returns a collection of bets where the provided user
     * has not made a pick and the games do not have scores
     */
    public function getUnpickedBets($userId)
    {
        return Cache::rememberForever("bets.{$userId}.unpicked", function () use ($userId) {
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
        $existing = $this->findByUserAndGame($args['user_id'], $args['sports_game_id']);
        if (!is_null($existing)) {
            throw new DuplicateBetException("User id: {$existing->user_id} already has a bet for game: {$existing->sports_game_id}");
        }
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

    public function updatePick(SportsBet $bet, int $sportsTeamId)
    {
        $bet->sports_team_id = $sportsTeamId;
        $bet->save();

        return $bet;
    }

    public function updateDoubled(SportsBet $bet, bool $doubled)
    {
        if ($doubled === true) {
            $count = $this->userDoubledForGroup($bet->user_id, $bet->game_group_id);
            if ($count > 1) {
                throw new DoubleDownLimitReachedException("The maximum number of games that can be doubled for this group has already been reached");
            }
        }

        $bet->doubled = $doubled;
        $bet->save();

        return $bet;
    }
}
