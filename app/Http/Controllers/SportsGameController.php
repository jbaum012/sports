<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\SportsGame;
use Illuminate\Http\Request;
use App\Http\Resources\SportsGameListItem;
use App\Repositories\SportsGameRepository;

class SportsGameController extends Controller
{
    public function __construct(public SportsGameRepository $repo) {}

    public function index()
    {
        return Inertia::render('SportsGames/SportsGamesIndex', [
            'games' => SportsGameListItem::collection($this->repo->search())
        ]);
    }

    public function create()
    {
        return Inertia::render('SportsGames/SportsGameShow', [
            'game' => new SportsGame()
        ]);
    }

    public function show(SportsGame $sportsGame)
    {
        return Inertia::render('SportsGames/SportsGameShow', [
            'game' => $sportsGame->only(
                'id',
                ...$sportsGame->getFillable(),
            )
        ]);
    }

    public function update(Request $request, SportsGame $sportsGame)
    {
        //
    }

    public function destroy(SportsGame $sportsGame)
    {
        //
    }
}
