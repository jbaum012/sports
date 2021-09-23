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

    public function getWinnersForGroup($group): ?array
    {
        if ($group->hasUnplayedGames()) {
            return null;
        }
        $results = $this->getResultsForGroup($group);
        if ($results === null) {
            return null;
        }
        $winners = array_keys($results, max($results));
        return $winners;
    }

    public function getResultsForGroup($group): array
    {
        $userBets = $group->userBets();
        $results = collect([]);
        foreach ($userBets as $userId => $bets) {
            $entry = [
                'score' => 0,
                'user_id' => $userId
            ];
            foreach ($bets as $bet) {
                $entry['score'] += $bet->points();
            }
            $results->push($entry);
        }
        return array_values($results->sortByDesc('score')->toArray());
    }
}
