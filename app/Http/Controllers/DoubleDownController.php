<?php

namespace App\Http\Controllers;

use App\Bet;
use Illuminate\Http\Request;
use App\Http\Resources\BetResource;

class DoubleDownController extends Controller
{
    public function store(Bet $bet)
    {
        if ($bet->user->doubleDownCount($bet->game->week) <= 1) {
            $bet->double_down = true;
            $bet->save();
        }
        return new BetResource($bet);
    }

    public function destroy(Bet $bet)
    {
        $bet->double_down = false;
        $bet->save();
        return new BetResource($bet);
    }
}
