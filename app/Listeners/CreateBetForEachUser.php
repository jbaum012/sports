<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use App\Repositories\SportsBetRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\SportsGames\SportsGameCreated;

class CreateBetForEachUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(public SportsBetRepository $repo)
    {
        //
    }

    public function handle(SportsGameCreated $event)
    {
        $users = User::all();
        $game = $event->sportsGame;
        foreach ($users as $user) {
            $bet = $this->repo->findByUserAndGame($user->id, $game->id);
            if (is_null($bet)) {
                $this->repo->create([
                    'game_group_id' => $game->game_group_id,
                    'sports_game_id' => $game->id,
                    'user_id' => $user->id
                ]);
            }
        }
    }
}
