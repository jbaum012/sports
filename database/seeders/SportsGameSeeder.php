<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\GameGroup;
use App\Models\SportsGame;
use App\Models\SportsTeam;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;

class SportsGameSeeder extends Seeder
{
    use WithFaker;

    /**
     * The current Faker instance.
     *
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->setUpFaker();
        if (SportsGame::count() > 0) {
            return;
        }

        $weeks = GameGroup::all();
        $gamesPerWeek = 10;
        $teams = SportsTeam::all();
        $user = User::find(1);
        $startDateSeed = -9;
        foreach ($weeks as $index => $week) {
            $gameTeams = clone $teams->shuffle();
            $start = Carbon::now()->addWeeks($startDateSeed + $index);
            for ($j = 0; $j < $gamesPerWeek; $j++) {
                $home = $gameTeams->pop();
                $away = $gameTeams->pop();
                $start->addDays(1);
                $data = [
                    'starts_at' => $start,
                    'game_group_id' => $week->id,
                    'home_team_id' => $home->id,
                    'away_team_id' => $away->id,
                    'created_by' => $user->id
                ];
                if ($start < Carbon::now()) {
                    $spread = $this->faker->randomElement([0, 1.5, 3, 3.5, 5, 7]);
                    $data['home_team_score'] = $this->faker->numberBetween(0, 35);
                    $data['away_team_score'] = $this->faker->numberBetween(0, 35);
                    $data['home_team_spread'] = $spread;
                    $data['away_team_spread'] = $spread * -1;
                }
                $game = SportsGame::factory()->create($data);
                if ($game->starts_at < Carbon::now()) {
                    foreach ($game->bets as $bet) {
                        $bet->sports_team_id = $this->faker->randomElement([
                        $game->home_team_id,
                        $game->away_team_id,
                    ]);
                        $bet->save();
                    }
                }
            }
        }
    }
}
