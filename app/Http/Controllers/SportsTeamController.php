<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\SportsTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Repositories\SportsTeamRepository;

class SportsTeamController extends Controller
{
    public function __construct(public SportsTeamRepository $repo) { }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Cache::rememberForever('teams', function () {
            return $this->repo->search()
                ->sortBy('division')
                ->groupBy('division');
        });
        return Inertia::render('SportsTeams/SportsTeamsIndex', [
            'divisions' => $teams
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Inertia::render('SportsTeams/SportsTeamShow', [
            'game' => $this->repo->create($request->all())
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SportsTeam  $sportsTeam
     * @return \Illuminate\Http\Response
     */
    public function show(SportsTeam $sportsTeam)
    {
        return Inertia::render('SportsTeams/SportsTeamShow', [
            'team' => $sportsTeam->only(
                'id',
                ...$sportsTeam->getFillable(),
            )
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SportsTeam  $sportsTeam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SportsTeam $sportsTeam)
    {
        $team = $this->repo->update($sportsTeam, $request->all());
        return Inertia::render('SportsTeams/SportsTeamDetails', [
            'team' => $team->only(
                'id',
                ...$sportsTeam->getFillable(),
            )
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SportsTeam  $sportsTeam
     * @return \Illuminate\Http\Response
     */
    public function destroy(SportsTeam $sportsTeam)
    {
        //
    }
}
