<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\SportsGame;
use App\Http\Controllers\Controller;
use App\Repositories\SportsBetRepository;
use App\Http\Resources\SportsGame as SportsGameResource;

class SportsGameBetsController extends Controller
{
    public function __construct(public SportsBetRepository $repo) {}

    public function index(SportsGame $game)
    {
        $bets = $this->repo->getBetsForGame($game->id);
        return Inertia::render('SportsGameBets/SportsGameBetsIndex', [
            'game' => new SportsGameResource($game),
            'bets' => $bets
        ]);
    }
}
