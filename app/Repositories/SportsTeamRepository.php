<?php
namespace App\Repositories;

use App\Models\SportsTeam;
use Illuminate\Support\Collection;

class SportsTeamRepository
{
    public function search(): Collection
    {
        return SportsTeam::select('name', 'location', 'abbreviation', 'division')->get();
    }

    public function create(array $args): SportsTeam
    {
        $team = new SportsTeam();
        return $this->update($team, $args);
    }

    public function update(SportsTeam $team, array $args): SportsTeam
    {
        $team->name = $args['name'];
        $team->location = $args['location'];
        $team->abbreviation = $args['abbreviation'];
        $team->division = $args['division'];
        $team->primary_color = $args['primary_color'];
        $team->secondary_color = $args['secondary_color'];
        $team->save();

        return $team;
    }

    public function getBirdTeamIds(): Collection
    {
        return SportsTeam::select('id')
            ->where('name', 'Ravens')
            ->orWhere('name', 'Seahawks')
            ->orWhere('name', 'Cardinals')
            ->orWhere('name', 'Eagles')
            ->orWhere('name', 'Falcons')
            ->get();
    }

    public function getCatTeamIds(): Collection
    {
        return SportsTeam::select('id')
            ->where('name', 'Panthers')
            ->orWhere('name', 'Lions')
            ->orWhere('name', 'Jaguars')
            ->orWhere('name', 'Bengals')
            ->get();
    }
}
