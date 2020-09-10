<?php

namespace App\Http\Controllers;

use App\Game;
use App\Http\Resources\GameResource;
use Illuminate\Http\Request;

class WeeklyGamesController extends Controller
{

    public function show($week_id)
    {
        $games = Game::where('season_id', env('BETTING_SEASON', 1))
            ->orderBy('starts_at')->get()
            ->where('week', $week_id);

        return GameResource::collection($games);
    }
}
