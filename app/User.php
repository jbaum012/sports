<?php

namespace App;

use PDO;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use PhpParser\Node\Expr\AssignOp\Mul;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function bets()
    {
        return $this->hasMany('App\Bet');
    }

    public function doubleDownCount($week)
    {
        $games = Week::firstOrFail('number', $week)->games;
        $filtered = $games->filter(function ($game) use ($week) {
            if (is_null($game->user_bet)) {
                return false;
            }
            return $game->week->number == $week && $game->user_bet->double_down;
        });
        return $filtered->count();
    }

    public function currentPoints()
    {
        $season = env('BETTING_SEASON', 1);
        $total = 0;
        foreach ($this->bets as $bet) {
            if ($bet->game->season_id != $season || is_null($bet->won)) {
                continue;
            }
            $multiplier = $bet->double_down ? 2 : 1;
            if ($bet->won) {
                $total = $total + (1 * $multiplier);
            } else {
                $total = $total - (1 * $multiplier);
            }
        }
        return $total;
    }

    public function weeklyPoints($week)
    {
        $bets = $this->bets->where('week_id', $week);
        $total = 0;
        foreach ($bets as $bet) {
            if (is_null($bet->won)) {
                continue;
            }
            $multiplier = $bet->double_down ? 2 : 1;
            if ($bet->won) {
                $total = $total + (1 * $multiplier);
            } else {
                $total = $total - (1 * $multiplier);
            }
        }
        return $total;
    }
}
