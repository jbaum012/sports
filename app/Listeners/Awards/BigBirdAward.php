<?php

namespace App\Listeners\Awards;

use App\Models\AwardType;
use App\Models\SportsAward;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use App\Repositories\SportsTeamRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\SportsGames\SportsGameScoresUpdated;

class BigBirdAward implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(public SportsTeamRepository $teamRepo)
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SportsGameScoresUpdated $event)
    {
        $birdTeams = $this->teamRepo->getBirdTeamIds();
        $game = $event->sportsGame;
        $isBirdGame = $birdTeams->contains($game->home_team_id)
            && $birdTeams->contains($game->away_team_id);
        if ($isBirdGame)
        {
            $type = AwardType::firstOrCreate([
                'name' => 'Big Bird',
                'description' => 'You picked the winning bird in a bird on bird game',
                'icon' => '&#129411;',
                'tailwind_class' => 'bg-green-300',
            ]);
            foreach($game->bets as $bet) {
                if($bet->won()) {
                    $award = SportsAward::firstOrCreate([
                        'award_type_id' => $type->id,
                        'game_group_id' => $game->game_group_id,
                        'sports_bet_id' => $bet->id,
                        'user_id' => $bet->user_id
                    ]);
                    Log::info("Big bird award created for {$bet->user_id}.");
                }
            }
        }
    }
}
