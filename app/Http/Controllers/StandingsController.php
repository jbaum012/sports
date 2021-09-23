<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Repositories\ResultsRepository;

class StandingsController extends Controller
{
    public function __construct(public ResultsRepository $repo) {}

    public function index()
    {
        $results = $this->repo->allResults();
        $users = User::all();
        return Inertia::render('Standings/StandingsIndex', [
            'standings' => $results,
            'users' => $users
        ]);
    }
}
