<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\GameGroup;
use App\Models\SportsGame;
use App\Models\SportsTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use App\Http\Resources\SportsGame as SportsGameResource;
use App\Repositories\SportsGameRepository;
use App\Http\Requests\SportsGames\StoreSportsGame;
use App\Http\Requests\SportsGames\UpdateSportsGame;

class SportsGameController extends Controller
{
    public function __construct(public SportsGameRepository $repo) {}

    public function index()
    {
        $games = $this->repo->fullGamesList();
        return Inertia::render('SportsGames/SportsGamesIndex', [
            'gamesByWeek' => $games
        ]);
    }

    public function create()
    {
        return $this->show(new SportsGame());
    }

    public function show(SportsGame $game)
    {
        $sportsGame = is_null($game->id)
            ? $game
            : new SportsGameResource($game);

        return Inertia::render('SportsGames/SportsGameShow', [
            'game' => $sportsGame,
            'groups' => GameGroup::all(),
            'teams' => SportsTeam::all()
        ]);
    }

    public function store(StoreSportsGame $request)
    {
        $game = $this->repo->create($request->all());
        return $this->show($game);
    }

    public function update(UpdateSportsGame $request, SportsGame $sportsGame)
    {
        $game = $this->repo->update($sportsGame, $request->all());
        return Redirect::route('games.show', $game->id);
    }

    public function destroy(SportsGame $sportsGame)
    {
    }
}
