<?php

namespace App\Http\Livewire\SportsTeam;

use App\Models\SportsTeam;
use Livewire\Component;

class Show extends Component
{
    public SportsTeam $team;

    public function render()
    {
        return <<<'blade'
            <div>
                {{ $team->name }}
            </div>
        blade;
    }
}
