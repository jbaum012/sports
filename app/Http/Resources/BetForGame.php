<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BetForGame extends JsonResource
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
            'user' => new UserDisplay($this->user),
            'team' => new SportsTeam($this->team),
            'points' => $this->points(),
            'won' => $this->won(),
            'doubled' => $this->doubled,
        ];
    }
}
