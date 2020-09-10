<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BetResource extends JsonResource
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
            'double_down' => $this->double_down,
            'game_id' => $this->game_id,
            'user' => $this->user->name,
            'user_avatar' => $this->user->avatar,
            'team' => new TeamResource($this->team),
            'won' => $this->won
        ];
    }
}
