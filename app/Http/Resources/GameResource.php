<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
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
            'season_id' => $this->season_id,
            'starts_at' => $this->starts_at,
            'home_team_score' => $this->home_team_score,
            'away_team_score' => $this->away_team_score,
            'spread' => $this->spread,
            'home_team' => new TeamResource($this->homeTeam),
            'away_team' => new TeamResource($this->awayTeam)
        ];
    }
}
