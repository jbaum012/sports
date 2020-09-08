<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeamsTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function team_games_returns_home_and_away_games()
    {
        $team = factory('App\Team')->create();

        $homeGames = factory('App\Game', 3)->create([
            'home_team_id' => $team->id,
        ]);

        $awayGames = factory('App\Game', 3)->create([
            'away_team_id' => $team->id,
        ]);

        $this->assertEquals(6, $team->games()->count());
    }

    /** @test **/
    public function team_can_get_games_by_week()
    {
        $date = Carbon::now();
        $weeksToAdd = 5;
        $season = factory('App\Season')->create([
            'starts_at' => $date
        ]);

        $team = factory('App\Team')->create();

        $games = factory('App\Game', 3)->create([
            'season_id' => $season->id,
            'home_team_id' => $team->id,
            'starts_at' => $date->addWeeks($weeksToAdd)
        ]);

        $this->assertEquals(3, $team->gamesForWeek($weeksToAdd + 1)->count());
    }
}
