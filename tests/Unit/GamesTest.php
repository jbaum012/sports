<?php

namespace Tests\Unit;

use App\Season;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GamesTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function game_returns_correct_week()
    {
        $season = factory(Season::class)->create([
            'starts_at' => Carbon::create('2020', '09', '10'),
        ]);

        $game1 = factory('App\Game')->create([
            'season_id' => $season->id,
            'starts_at' => Carbon::create('2020', '10', '08', '19', '30', 0)
        ]);

        $game2 = factory('App\Game')->create([
            'season_id' => $season->id,
            'starts_at' => Carbon::create('2020', '09', '10', '19', '30', 0)
        ]);

        $game3 = factory('App\Game')->create([
            'season_id' => $season->id,
            'starts_at' => Carbon::create('2020', '11', '19', '19', '30', 0)
        ]);

        $this->assertEquals(5, $game1->week);
        $this->assertEquals(1, $game2->week);
        $this->assertEquals(11, $game3->week);
    }

    /** @test **/
    public function higher_score_returns_correct_winner()
    {
        $game1 = factory('App\Game')->create([
            'home_team_score' => 1,
            'away_team_score' => 0
        ]);

        $game2 = factory('App\Game')->create([
            'home_team_score' => 0,
            'away_team_score' => 1
        ]);

        $this->assertEquals($game1->homeTeam, $game1->winner);
        $this->assertEquals($game2->awayTeam, $game2->winner);
    }

    /** @test **/
    public function null_score_returns_null_winner()
    {
        $game1 = factory('App\Game')->create([
            'home_team_score' => 1,
            'away_team_score' => null
        ]);

        $this->assertNull($game1->winner);
    }
}