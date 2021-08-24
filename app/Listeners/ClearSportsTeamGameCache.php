<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Cache;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClearSportsTeamGameCache
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $game = $event->sportsGame;
        Cache::forget("sports_team.{$game->home_team_id}.games");
        Cache::forget("sports_team.{$game->away_team_id}.games");
        Cache::forget("sports_games");
    }
}
