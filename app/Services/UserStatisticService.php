<?php

namespace App\Services;

use App\Game;
use App\Team;
use App\User;
use App\Season;
use App\Http\Resources\TeamResource;
use Illuminate\Support\Facades\Auth;
use PDO;

class UserStatisticService
{
    protected $user;
    protected $week;
    protected $games;
    protected $winnings;

    public function __construct()
    {
        $season = Season::find(env('BETTING_SEASON', 1));
        $this->games = Game::with('bets')->get();
        $this->week = $season->currentWeek();
        $this->winnings = $season->winnings();
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getUserStats()
    {
        if (empty($this->user->bets)) {
            return null;
        }
        return [
            'id' => $this->user->id,
            'name' => $this->user->name,
            'avatar' => $this->user->avatar,
            'points' => $this->user->currentPoints(),
            'weekly_points' => $this->user->weeklyPoints($this->week),
            'lone_wolf' => $this->loneWolf(),
            'loan_wolf' => $this->loanWolf(),
            'dicked' => $this->dicked(),
            'strong_arm' => $this->strongArm(),
            'limp_dick' => $this->limpDick(),
            'better_than_tony' => $this->betterThanTony(),
            'favorite_team' => $this->favoriteTeam(),
            'rejected' => $this->rejected(),
            'double_do' => $this->doubleDo(),
            'double_dont' => $this->doubleDont(),
            '200_iq' => $this->twoHundredIq(),
            'winnings' => $this->winnings[$this->user->id]
        ];
    }

    // Number of times user was the only one to win a bet
    public function loneWolf()
    {
        $count = 0;
        foreach ($this->games as $game) {
            if ($game->betsForAway()->count() === 1) {
                $bet = $game->betsForAway()->first();
                if ($bet->user_id === $this->user->id && $bet->won) {
                    ++$count;
                }
            }
            if ($game->betsForHome()->count() === 1) {
                $bet = $game->betsForHome()->first();
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
                $bet = $game->betsForAway()->first();
                if ($bet->user_id === $this->user->id && $bet->won === false) {
                    ++$count;
                }
            }
            if ($game->betsForHome()->count() === 1) {
                $bet = $game->betsForHome()->first();
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
        $count = 0;
        foreach ($this->user->bets as $bet) {
            $lost = $bet->won === false;
            $teamWonGame = $bet->team_id === $bet->game->scoreWinner()->id;
            if ($lost && $teamWonGame) {
                ++$count;
            }
        }
        return $count;
    }

    // number of times you picked the losing team and won due to spread
    public function twoHundredIq()
    {
        $count = 0;
        foreach ($this->user->bets as $bet) {
            $won = $bet->won;
            $teamLostGame = $bet->team_id !== $bet->game->scoreWinner()->id;
            if ($won && $teamLostGame) {
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
                $currentValue = isset($wonTeams[$bet->team_id]) ? $wonTeams[$bet->team_id] : 0;
                $wonTeams[$bet->team_id] = $currentValue + (1 * $multiplier);
            }
        }
        if (count($wonTeams) === 0) {
            return null;
        }
        $teams = array_keys($wonTeams, max($wonTeams));
        return count($teams) === 0 ? null : [
            'team' => new TeamResource(Team::find($teams[0])),
            'score' => max($wonTeams)
        ];
    }

    // team that has lost the user the most points (none if tied)
    public function limpDick()
    {
        $lostTeams = [];
        foreach ($this->user->bets as $bet) {
            if ($bet->won === false) {
                $multiplier = $bet->double_down ? 2 : 1;
                $currentValue = isset($lostTeams[$bet->team_id]) ? $lostTeams[$bet->team_id] : 0;
                $lostTeams[$bet->team_id] = $currentValue + (1 * $multiplier);
            }
        }
        if (count($lostTeams) === 0) {
            return null;
        }
        $teams = array_keys($lostTeams, max($lostTeams));
        return count($teams) === 0 ? null : [
            'score' => max($lostTeams),
            'team' => new TeamResource(Team::find($teams[0]))
        ];
    }

    // does the user have more points than Tony
    public function betterThanTony()
    {
        $tony = User::where('name', 'Tony Vetter')->first();
        if (is_null($tony)) {
            return false;
        }
        return $this->user->weeklyPoints($this->week) > $tony->weeklyPoints($this->week);
    }

    // Most picked team
    public function favoriteTeam()
    {
        if (empty($this->user->bets)) {
            return null;
        }
        $picks = [];
        foreach ($this->user->bets as $bet) {
            $currentFrequency = isset($picks[$bet->team->id]) ? $picks[$bet->team->id] : 0;
            $picks[$bet->team->id] = $currentFrequency + 1;
        }
        $team = array_keys($picks, max($picks));
        return count($team) === 0 ? null : [
            'team' => new TeamResource(Team::find($team[0])),
            'score' => max($picks)
        ];
    }

    // Most picked against team
    public function rejected()
    {
        if (empty($this->user->bets)) {
            return null;
        }
        $betAgainst = [];
        foreach ($this->user->bets as $bet) {
            $pickedTeam = $bet->team;
            $otherTeam = $bet->game->opponent($pickedTeam->id);
            $currentFrequency = isset($betAgainst[$otherTeam->id]) ? $betAgainst[$otherTeam->id] : 0;
            $betAgainst[$otherTeam->id] = $currentFrequency + 1;
        }
        $teams = array_keys($betAgainst, max($betAgainst));
        return count($teams) === 0 ? null : [
            'team' => new TeamResource(Team::find($teams[0])),
            'score' => max($betAgainst)
        ];
    }

    // Number of times user won a double down
    public function doubleDo()
    {
        return $this->user->bets->where('double_down', true)->where('won', true)->count();
    }

    // Number of times user lost a double down
    public function doubleDont()
    {
        return $this->user->bets->where('double_down', true)->whereNotNull('won')->where('won', false)->count();
    }
}
