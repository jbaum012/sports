<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClearUnplacedBetsCache
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
        //
        $users = User::all();
        foreach ($users as $user) {
            # code...
            Cache::forget("bets.{$user->id}.unplaced");
        }
    }
}
