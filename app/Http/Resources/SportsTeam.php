<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SportsTeam extends JsonResource
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
            'name' => $this->name,
            'location' => $this->location,
            'abbreviation' => $this->abbreviation,
            'division' => $this->division,
            'primary_color' => $this->primary_color,
            'secondary_color' => $this->secondary_color
        ];
    }
}
