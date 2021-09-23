<?php
namespace App\Repositories;

use Carbon\Carbon;
use App\Models\User;
use App\Models\GameGroup;
use Illuminate\Support\Collection;

class ResultsRepository
{
    public function allResults()
    {
        $results = [];
        $groups = GameGroup::with('games')
            ->with('bets')
            ->get()
            ->reverse();
        foreach ($groups as $group) {
            if ($group->hasPendingOrPlayedGames()) {
                $data = [];
                $data['results'] = $this->getResultsForGroup($group);
                $data['winners'] = $this->getWinnersForGroup($group);
                $results[$group->label] = $data;
            }
        }
        return $results;
    }

    public function getWinnersForGroup($group): Collection
    {
        $results = $this->getResultsForGroup($group);
        if ($results === null) {
            return null;
        }
        $winners = array_keys($results, max($results));
        return User::whereIn('id', $winners)->get();
    }

    public function getResultsForGroup($group)
    {
        $userBets = $group->userBets();
        $results = [];
        foreach ($userBets as $userId => $bets) {
            $score = 0;
            $betsArray = [];
            foreach ($bets as $bet) {
                $score += $bet->points();
                $betsArray[$bet->id] = $bet->points();
            }
            $results[$userId] = $score;
        }
        return asort($results);
    }
}
