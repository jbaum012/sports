<?php

namespace App\Services;

use App\Game;
use App\User;
use App\Http\Resources\UserStatsResource;

class UserStatisticService
{
    protected $user;
    protected $games;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->games = Game::all();
    }

    public function getUserStats()
    {
        return [
            'id' => $this->user->id,
            'name' => $this->user->name,
            'avatar' => $this->user->avatar,
            'lone_wolf' => $this->loneWolf(),
            'loan_wolf' => $this->loanWolf(),
            'dicked' => $this->dicked(),
            'strong_arm' => $this->strongArm(),
            'strong_arm' => $this->strongArm(),
            'limp_dick' => $this->limpDick(),
            'better_than_tony' => $this->betterThanTony(),
            'favorite_team' => $this->favoriteTeam(),
            'be_gone' => $this->beGone(),
            'double_do' => $this->doubleDo(),
            'double_dont' => $this->doubleDont(),
            '200_iq' => $this->twoHundredIq()
        ];
    }

    // Number of times user was the only one to win a bet
    public function loneWolf()
    {
        $count = 0;
        foreach ($this->games as $game) {
            if ($game->betsForAway()->count() === 1) {
                $bet = $game->betsForAway()[0];
                if ($bet->user_id === $this->user->id && $bet->won) {
                    ++$count;
                }
            }
            if ($game->betsForHome()->count() === 1) {
                $bet = $game->betsForHome()[0];
                if ($bet->user_id === $this->user->id && $bet->won) {
                    ++$count;
                }
            }
        }
        return $count;
    }

    // Number of times user was the only one to lose a bet
    public function loanWolf()
    {
        $count = 0;
        foreach ($this->games as $game) {
            if ($game->betsForAway()->count() === 1) {
                $bet = $game->betsForAway()[0];
                if ($bet->user_id === $this->user->id && $bet->won === false) {
                    ++$count;
                }
            }
            if ($game->betsForHome()->count() === 1) {
                $bet = $game->betsForHome()[0];
                if ($bet->user_id === $this->user->id && $bet->won === false) {
                    ++$count;
                }
            }
        }
        return $count;
    }

    // Number of times user lost only because of the spread
    public function dicked()
    {
        $count = null;
        foreach ($this->user->bets as $bet) {
            $lost = $bet->won === false;
            $teamWonGame = $bet->team === $bet->game->scoreWinner();
            if ($lost && $teamWonGame) {
                ++$count;
            }
        }
        return $count;
    }

    // Team that has gotten user the most points (none if tied)
    public function strongArm()
    {
        $wonTeams = [];
        foreach ($this->user->bets as $bet) {
            if ($bet->won) {
                $multiplier = $bet->double_down ? 2 : 1;
                $wonTeams[$bet->team_id] = $wonTeams[$bet->team_id] + (1 * $multiplier);
            }
        }
        if (count($wonTeams) === 0) {
            return null;
        }
        $teams = array_keys($wonTeams, min($wonTeams));
        return count($teams) > 1 ? null : $teams[0];
    }

    // team that has lost the user the most points (none if tied)
    public function limpDick()
    {
        $lostTeams = [];
        foreach ($this->user->bets as $bet) {
            if ($bet->won) {
                $multiplier = $bet->double_down ? 2 : 1;
                $lostTeams[$bet->team_id] = $lostTeams[$bet->team_id] - (1 * $multiplier);
            }
        }
        if (count($lostTeams) === 0) {
            return null;
        }
        $teams = array_keys($lostTeams, min($lostTeams));
        return count($teams) > 1 ? null : $teams[0];
    }

    // does the user have more points than Tony
    public function betterThanTony()
    {
    }

    // Most picked team
    public function favoriteTeam()
    {
    }

    // Most picked against team
    public function beGone()
    {
    }

    // Number of times user won a double down
    public function doubleDo()
    {
    }

    // Number of times user lost a double down
    public function doubleDont()
    {
    }

    // number of times you picked the losing team and won due to spread
    public function twoHundredIq()
    {
    }
}
