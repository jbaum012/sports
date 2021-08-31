<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\SportsBetRepository;
use App\Http\Resources\SportsBet as SportsBetResource;

class SportsBetController extends Controller
{
    public function __construct(public SportsBetRepository $repo) {}

    public function index()
    {
        $bets = $this->repo->betsForUser(Auth::user()->id);
        return Inertia::render('SportsBets/SportsBetsIndex', [
            'bets' => $bets,
        ]);
    }
}
