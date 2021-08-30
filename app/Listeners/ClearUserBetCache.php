<?php

namespace App\Listeners;

use App\Events\SportsBetUpdated;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClearUserBetCache
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
    public function handle(SportsBetUpdated $event)
    {
        $bet = $event->sportsBet;
        Cache::forget("bets.{$bet->user_id}.unplaced");
        Log::warning("bet cache cleared for {$bet->user_id}");
    }
}
