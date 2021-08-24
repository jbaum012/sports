<?php

namespace Database\Seeders;

use App\Models\GameGroup;
use App\Models\SportsGame;
use App\Models\SportsTeam;
use Illuminate\Database\Seeder;

class SportsGameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (SportsGame::count() > 0) {
            return;
        }

        $weeks = GameGroup::all();
        $gamesPerWeek = 10;
        $teams = SportsTeam::all();
        foreach ($weeks as $week) {
            $gameTeams = clone $teams->shuffle();
            for ($j = 0; $j < $gamesPerWeek; $j++) {
                $home = $gameTeams->pop();
                $away = $gameTeams->pop();
                $game = SportsGame::factory()->create([
                    'game_group_id' => $week->id,
                    'home_team_id' => $home->id,
                    'away_team_id' => $away->id,
                ]);
                event('eloquent.created: App\SportsGame', $game);
            }
        }
    }
}
