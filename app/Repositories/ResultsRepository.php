<?php
namespace App\Repositories;

use App\Models\User;
use App\Models\GameGroup;
use Illuminate\Support\Collection;

class ResultsRepository
{
    public function allResults()
    {
        $results = [];
        $groups = GameGroup::all();
        foreach ($groups as $group) {
            $data = [];
            $data['results'] = $this->getResultsForGroup($group->id);
            $data['winners'] = $this->getWinnersForGroup($group->id);
        }
        return $results;
    }

    public function getWinnersForGroup(int $groupId): Collection
    {
        $results = $this->getResultsForGroup($groupId);
        $winners = array_keys($results, max($results));
        return User::whereIn('id', $winners)->get();
    }

    public function getResultsForGroup(int $groupId)
    {
        $group = GameGroup::firstOrFail('id', $groupId);
        $userBets = $group->userBets();
        $results = [];
        foreach ($userBets as $userId => $bets) {
            $score = $bets->reduce(function ($carry, $item) {
                return $carry + $item->points();
            });
            $results[$userId] = $score;
        }
        return $results;
    }
}
