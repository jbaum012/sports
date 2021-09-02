<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\SportsBetRepository;

class ResultsController extends Controller
{
    public function __construct(public SportsBetRepository $repo) {}

    public function index()
    {
        $bets = $this->repo->resultsForUser(Auth::user()->id);
        return Inertia::render('Results/ResultsIndex', [
            'bets' => $bets,
        ]);
    }
}
