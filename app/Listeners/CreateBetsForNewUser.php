<?php

namespace App\Listeners;

use App\Models\SportsGame;
use App\Events\UserCreated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use App\Repositories\SportsBetRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateBetsForNewUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(public SportsBetRepository $repo) { }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $user = $event->user;
        $games = SportsGame::all();
        foreach($games as $game)
        {
            $this->repo->create([
                'game_group_id' => $game->game_group_id,
                'sports_game_id' => $game->id,
                'user_id' => $user->id
            ]);
        }
    }
}
