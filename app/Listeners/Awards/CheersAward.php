<?php

namespace App\Listeners\Awards;

use App\Models\AwardType;
use App\Models\SportsAward;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use App\Repositories\SportsTeamRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheersAward implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(public SportsTeamRepository $teamRepo) {}

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $game = $event->sportsGame;
        $type = AwardType::firstOrCreate([
            'name' => 'Cheers',
            'description' => "'ello Gov'na",
            'icon' => '&#127867;',
            'tailwind_class' => 'bg-pink-300',
        ]);
        $losers = collect([]);
        foreach($game->bets as $bet) {
            if(!$bet->won()) {
                $losers->push($bet);
            }
        }
        if ($losers->count() === 0) {
            foreach($game->bets as $bet) {
                $award = SportsAward::firstOrCreate([
                    'award_type_id' => $type->id,
                    'game_group_id' => $game->game_group_id,
                    'sports_bet_id' => $bet->id,
                    'user_id' => $bet->user_id
                ]);
                Log::info("Cheers found/created for {$bet->user_id}.");
            }
        }
    }
}
