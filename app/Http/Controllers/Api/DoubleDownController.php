<?php

namespace App\Http\Controllers\Api;

use App\Models\SportsBet;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoubleDownRequest;
use App\Repositories\SportsBetRepository;

class DoubleDownController extends Controller
{
    public function __construct(public SportsBetRepository $repo) {}

    public function store(SportsBet $bet)
    {
        return $this->repo->updateDoubled($bet, true);
    }

    public function destroy(SportsBet $bet)
    {
        return $this->repo->updateDoubled($bet, false);
    }
}
