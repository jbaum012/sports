<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\GameGroup;
use App\Models\SportsGame;
use App\Models\SportsTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use App\Http\Resources\SportsGameListItem;
use App\Repositories\SportsGameRepository;
use App\Http\Requests\SportsGames\StoreSportsGame;

class SportsGameController extends Controller
{
    public function __construct(public SportsGameRepository $repo) {}

    public function index()
    {
        // 1 day
        $cacheTime = 60 * 60 * 24;
        $games = Cache::remember('sports_games', $cacheTime, function () {
            return SportsGameListItem::collection($this->repo->search())
                ->collection
                ->groupBy('game_group_id');
        });
        return Inertia::render('SportsGames/SportsGamesIndex', [
            'gamesByWeek' => array_reverse($games->toArray())
        ]);
    }

    public function create()
    {
        return $this->show(new SportsGame());
    }

    public function show(SportsGame $sportsGame)
    {
        return Inertia::render('SportsGames/SportsGameShow', [
            'game' => $sportsGame,
            'groups' => GameGroup::all(),
            'teams' => SportsTeam::all()
        ]);
    }

    public function store(StoreSportsGame $request)
    {
        $game = $this->repo->create($request->all());
        return Redirect::route('games.show', $game->id);
    }

    public function update(Request $request, SportsGame $sportsGame)
    {
    }

    public function destroy(SportsGame $sportsGame)
    {
    }
}
