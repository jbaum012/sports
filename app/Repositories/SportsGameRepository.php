<?php
namespace App\Repositories;

use App\Models\SportsGame;
use Illuminate\Support\Collection;

class SportsGameRepository
{
    public function search(): Collection
    {
        return SportsGame::all();
    }
}
