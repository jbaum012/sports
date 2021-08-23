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
}
