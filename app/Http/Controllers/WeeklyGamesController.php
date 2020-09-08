<?php

namespace App\Http\Controllers;

use App\Game;
use App\Http\Resources\GameResource;
use Illuminate\Http\Request;

class WeeklyGamesController extends Controller
{
    public function show($week)
    {
        $games = Game::where('season_id', env('BETTING_SEASON', 1))
            ->orderBy('starts_at')->get()
            ->where('week', $week);

        return GameResource::collection($games);
    }
}
