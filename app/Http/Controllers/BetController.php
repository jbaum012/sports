<?php

namespace App\Http\Controllers;

use App\Bet;
use App\Game;
use Illuminate\Http\Request;
use App\Http\Resources\BetResource;
use Illuminate\Support\Facades\Auth;

class BetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TODO: real validation
        $args = $request->all();
        $game = Game::find($args['game_id']);
        if ($game->allowNewBets()) {
            $bet = new Bet();
            $bet->team_id = $args['team_id'];
            $bet->game_id = $args['game_id'];
            $bet->user_id = Auth::id();
            $bet->double_down = false;
            $bet->save();
        }
        return new BetResource($bet);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bet  $bet
     * @return \Illuminate\Http\Response
     */
    public function show($game_id)
    {
        $bet = Bet::where('user_id', Auth::id())
            ->where('game_id', $game_id)
            ->firstOrFail();
        return new BetResource($bet);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bet  $bet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bet $bet)
    {
        // TODO: real validation
        if ($bet->game->allowNewBets()) {
            $args = $request->all();
            $bet->team_id = $args['team_id'];
            $bet->save();
            return new BetResource($bet);
        }
        return new BetResource($bet);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bet  $bet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bet $bet)
    {
        //
    }
}
