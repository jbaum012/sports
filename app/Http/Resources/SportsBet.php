<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SportsBet extends JsonResource
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
            'user_id' => $this->user_id,
            'group' => $this->group->label,
            'game' => new SportsGame($this->game),
            'team' => new SportsTeam($this->team),
            'points' => $this->points(),
            'won' => $this->won(),
            'doubled' => $this->doubled,
            'locked' => $this->locked()
        ];
    }
}
