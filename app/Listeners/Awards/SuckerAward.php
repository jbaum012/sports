<?php

namespace App\Listeners\Awards;

use App\Models\User;
use App\Models\AwardType;
use App\Models\SportsAward;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use App\Repositories\SportsTeamRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class SuckerAward
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
            'name' => 'Sucker',
            'description' => "You're a sucker, and your pick lost.",
            'icon' => '&#1128058;',
            'tailwind_class' => 'bg-indigo-300',
        ]);
        $losers = collect([]);
        foreach($game->bets as $bet) {
            if(!$bet->won()) {
                $losers->push($bet);
            }
        }
        if ($losers->count() === 1) {
            $loneLoser = $losers->first();
            $award = SportsAward::firstOrCreate([
                'award_type_id' => $type->id,
                'game_group_id' => $game->game_group_id,
                'sports_bet_id' => $loneLoser->id,
                'user_id' => $loneLoser->user_id
            ]);
            Log::info("Sucker award found/created for {$loneLoser->user_id}.");
        }
    }
}
