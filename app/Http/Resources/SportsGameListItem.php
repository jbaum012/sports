<?php

namespace App\Http\Resources;

use App\Http\Resources\SportsTeam;
use Illuminate\Http\Resources\Json\JsonResource;

class SportsGameListItem extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'group' => $this->group->label,
            'home_team' => new SportsTeam($this->homeTeam),
            'away_team' => new SportsTeam($this->awayTeam),
            'home_team_score' => $this->home_team_score,
            'away_team_score' => $this->away_team_score,
            'home_team_spread' => $this->home_team_spread,
            'away_team_spread' => $this->away_team_spread,
            'starts_at' => $this->starts_at->format('c')
        ];
    }
}
