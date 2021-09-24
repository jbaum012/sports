<?php

namespace App\Listeners\Awards;

use App\Models\AwardType;
use App\Models\SportsAward;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use App\Repositories\SportsTeamRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class TigerKingAward implements ShouldQueue
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
        $catTeams = $this->teamRepo->getCatTeamIds();
        $game = $event->sportsGame;
        $isCatGame = $catTeams->contains($game->home_team_id)
            && $catTeams->contains($game->away_team_id);
        if ($isCatGame) {
            $type = AwardType::firstOrCreate([
                'name' => 'Tiger King',
                'description' => 'You picked the winning cat in a cat on cat game',
                'icon' => '&#128005;',
                'tailwind_class' => 'bg-blue-300',
            ]);
            foreach ($game->bets as $bet) {
                if ($bet->won()) {
                    $award = SportsAward::firstOrCreate([
                        'award_type_id' => $type->id,
                        'game_group_id' => $game->game_group_id,
                        'sports_bet_id' => $bet->id,
                        'user_id' => $bet->user_id
                    ]);
                    Log::info("Tiger king award found/created for {$bet->user_id}.");
                }
            }
        }
    }
}
