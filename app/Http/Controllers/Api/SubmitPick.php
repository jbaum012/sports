<?php

namespace App\Http\Controllers\Api;

use App\Models\SportsBet;
use Illuminate\Http\Request;
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
        return $this->repo->updatePick($bet, $request->sports_team_id);
    }
}
