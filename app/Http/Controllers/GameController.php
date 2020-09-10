<?php

namespace App\Http\Controllers;

use App\Game;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\GameResource;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::all();
        $collection = GameResource::collection($games);
        return $collection->groupBy('week')->reverse();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $args = $request->all();
        $game = new Game();
        $game->season_id = env('BETTING_SEASON', 1);
        $game->home_team_id = $args['home_team_id'];
        $game->away_team_id = $args['away_team_id'];
        $game->spread_team_id = $args['spread_team_id'];
        $date = new Carbon($args['date']);
        $time = new Carbon($args['time']);
        $dateTime = new Carbon($date->format('Y-m-d') . ' ' . $time->format('H:i:s'));
        $game->starts_at = $dateTime;
        $game->home_team_score = $args['home_team_score'];
        $game->away_team_score = $args['away_team_score'];
        $game->spread = $args['spread'];
        $game->spread_team_id = $args['spread_team_id'];
        $game->save();

        return new GameResource($game);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        return new GameResource($game);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        $args = $request->all();
        $game->home_team_id = $args['home_team_id'];
        $game->away_team_id = $args['away_team_id'];
        $game->spread_team_id = $args['spread_team_id'];
        $date = new Carbon($args['date']);
        $time = new Carbon($args['time']);
        $dateTime = new Carbon($date->format('Y-m-d') . ' ' . $time->format('H:i:s'));
        $game->starts_at = $dateTime;
        $game->home_team_score = $args['home_team_score'];
        $game->away_team_score = $args['away_team_score'];
        $game->spread = $args['spread'];
        $game->spread_team_id = $args['spread_team_id'];
        $game->save();
        return new GameResource($game);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        $game->delete();
        return response(null, 204);
    }
}
