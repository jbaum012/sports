<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\PlaceBetAfterGameStartsException;
use Carbon\Carbon;
use App\Models\SportsBet;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubmitPickRequest;
use App\Repositories\SportsBetRepository;

class SubmitPick extends Controller
{

    public function __construct(public SportsBetRepository $repo) { }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(SubmitPickRequest $request, SportsBet $bet)
    {
        if ($bet->game->starts_at <= Carbon::now()) {
            throw new PlaceBetAfterGameStartsException("Bets cannot be placed after the game has started");
        }
        return $this->repo->updatePick($bet, $request->sports_team_id);
    }
}
