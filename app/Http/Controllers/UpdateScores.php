<?php

namespace App\Http\Controllers;

use App\Models\SportsGame;
use Illuminate\Support\Facades\Redirect;
use App\Events\SportsGames\SportsGameScoresUpdated;
use App\Http\Requests\SportsGames\UpdateGameScores;

class UpdateScores extends Controller
{
    public function __invoke(UpdateGameScores $request, SportsGame $game)
    {
        $game->home_team_score = $request['home_team_score'];
        $game->away_team_score = $request['away_team_score'];
        $game->save();
        SportsGameScoresUpdated::dispatch($game);
        return Redirect::route('games.show', $game->id);
    }
}
