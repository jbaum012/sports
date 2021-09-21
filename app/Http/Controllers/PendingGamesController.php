<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\SportsGameRepository;

class PendingGamesController extends Controller
{
    public function __construct(public SportsGameRepository $repo) {}

    public function index()
    {
        $games = $this->repo->pendingGames();
        return Inertia::render('PendingGames/PendingGamesIndex', [
            'gamesByWeek' => $games
        ]);
    }
}
