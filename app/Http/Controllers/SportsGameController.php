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
        // 1 day
        $cacheTime = 60 * 60 * 24;
        $games = Cache::remember('sports_games', $cacheTime, function () {
            $collection = SportsGameResource::collection($this->repo->search());
            $groups = $collection->collection->groupBy('game_group_id');
            $reversed = array_reverse($groups->toArray());
            return $reversed;
        });
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
        return Inertia::render('SportsGames/SportsGameShow', [
            'game' => new SportsGameResource($game),
            'groups' => GameGroup::all(),
            'teams' => SportsTeam::all()
        ]);
    }

    public function store(StoreSportsGame $request)
    {
        $game = $this->repo->create($request->all());
        return Redirect::route('games.show', $game->id);
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
