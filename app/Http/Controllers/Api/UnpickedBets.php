<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\SportsBetRepository;
use App\Http\Resources\SportsBet as SportsBetResource;
use App\Http\Requests\UnpickedBetsRequest as UnpickedBetsRequest;

class UnpickedBets extends Controller
{

    public function __construct(public SportsBetRepository $repo) {}

    public function __invoke()
    {
        $bets = $this->repo->getUnpickedBets(Auth::user()->id);
        return SportsBetResource::collection($bets);
    }
}
