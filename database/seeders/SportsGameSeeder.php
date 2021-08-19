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
        $weeks = 18;
        $gamesPerWeek = 10;
        $gameGroups = [];
        $teams = SportsTeam::all();
        for ($i = 1; $i <= $weeks; $i++) {
            $group = GameGroup::factory()->create([
                'label' => "Week $i"
            ]);
            $gameGroups[] = $group;
            $gameTeams = clone $teams->shuffle();
            for ($j = 0; $j < $gamesPerWeek; $j++) {
                $home = $gameTeams->pop();
                $away = $gameTeams->pop();
                SportsGame::factory()->create([
                    'game_group_id' => $group->id,
                    'home_team_id' => $home->id,
                    'away_team_id' => $away->id,
                ]);
            }
        }
    }
}
