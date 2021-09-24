<?php

namespace App\Listeners\Awards;

use App\Models\AwardType;
use App\Models\SportsAward;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use App\Repositories\SportsTeamRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class LoneWolfAward
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
            'name' => 'Lone Wolf',
            'description' => "You're a loner, and your pick won.",
            'icon' => '&#1128058;',
            'tailwind_class' => 'bg-green-300',
        ]);
        $winners = collect([]);
        foreach($game->bets as $bet) {
            if($bet->won()) {
                $winners->push($bet);
            }
        }
        if ($winners->count() === 1) {
            $loneWinner = $winners->first();
            $award = SportsAward::firstOrCreate([
                'award_type_id' => $type->id,
                'game_group_id' => $game->game_group_id,
                'sports_bet_id' => $loneWinner->id,
                'user_id' => $loneWinner->user_id
            ]);
            Log::info("Lone Wolf award found/created for {$loneWinner->user_id}.");
        }
    }
}
