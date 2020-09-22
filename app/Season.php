<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    protected $casts = [
        'starts_at' => 'datetime',
    ];

    public function currentWeek()
    {
        return $this->starts_at->diffInWeeks(Carbon::now()) + 1;
    }

    public function games()
    {
        return $this->hasMany('App\Game');
    }

    public function winnings()
    {
        $users = User::all();
        $weeklyScores = [];
        $winnings = [];
        foreach (range(1, $this->currentWeek()) as $week) {
            $points = [];
            foreach ($users as $user) {
                if (is_null($user->weeklyPoints($week))) {
                    continue;
                }
                $points[] = $user->weeklyPoints($week);
            }
            rsort($points);
            if (count(array_unique($points)) === 1) {
                continue;
            }
            $weeklyScores[$week] = $points;
        }
        foreach ($weeklyScores as $week => $scores) {
            $winners = current(array_count_values($scores));
            foreach ($users as $user) {
                if (!isset($winnings[$user->id])) {
                    $winnings[$user->id] = 0;
                }
                $won = array_search($user->weeklyPoints($week), $scores) === 0;
                if ($won) {
                    $score = floor((count($scores) * $this->score_card_cost / $winners) - $this->score_card_cost);
                } else {
                    $score  = -$this->score_card_cost;
                }
                $winnings[$user->id] += $score;
            }
        }
        return $winnings;
    }
}
