<?php

namespace App\Http\Controllers;

use App\Models\SportsGame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Events\SportsGames\SportsGameScoresUpdated;
use App\Http\Requests\SportsGames\UpdateGameScores;

class SportsGameScoresController extends Controller
{
    public function update(UpdateGameScores $request, SportsGame $game)
    {
        $game->home_team_score = $request['home_team_score'];
        $game->away_team_score = $request['away_team_score'];
        $game->save();
        SportsGameScoresUpdated::dispatch($game);
        return Redirect::route('games.show', $game->id);
    }

    public function destroy(SportsGame $game)
    {
        $game->home_team_score = null;
        $game->away_team_score = null;
        $game->save();

        SportsGameScoresUpdated::dispatch($game);
        return Redirect::route('games.show', $game->id);
    }
}
