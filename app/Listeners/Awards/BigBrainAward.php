<?php

namespace App\Listeners\Awards;

use App\Models\AwardType;
use App\Models\SportsAward;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use App\Repositories\SportsTeamRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class BigBrainAward implements ShouldQueue
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
            'name' => 'Big Brain',
            'description' => "Your pick won the spread but didn't win the game",
            'icon' => '&#129504;',
            'tailwind_class' => 'bg-yellow-300',
        ]);
        foreach ($game->bets as $bet) {
            if ($bet->won() && $game->winner()?->id !== $game->spreadWinner()?->id) {
                $award = SportsAward::firstOrCreate([
                    'award_type_id' => $type->id,
                    'game_group_id' => $game->game_group_id,
                    'sports_bet_id' => $bet->id,
                    'user_id' => $bet->user_id
                ]);
                Log::info("Big Brain award found/created for {$bet->user_id}.");
            }
        }
    }
}
