<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
            'home_team_id' => $this->home_team_id,
            'away_team_id' => $this->away_team_id,
            'spread_team_id' => $this->spread_team_id,
            'date' => $this->starts_at->toJSON(),
            'time' => $this->starts_at->format('H:i:s'),
            'home_team_score' => $this->home_team_score,
            'away_team_score' => $this->away_team_score,
            'spread' => $this->spread,
            'spread_team' => new TeamResource($this->spreadTeam),
            'home_team' => new TeamResource($this->homeTeam),
            'away_team' => new TeamResource($this->awayTeam),
            'user_bet' => new BetResource($this->userBet),
            'allow_bets' => $this->allowNewBets()
        ];
    }
}
