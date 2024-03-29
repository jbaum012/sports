<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\SportsGame;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SportsGameTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function spread_winner_is_null_if_split()
    {
        $game = SportsGame::factory()->make([
            'home_team_score' => 18,
            'away_team_score' => 23,
            'home_team_spread' => 5,
            'away_team_spread' => -5,
        ]);

        $this->assertNull($game->spreadWinner());
    }

    /** @test */
    public function can_access_created_by()
    {
        $game = SportsGame::factory()->create();
        $this->assertNotNull($game->createdBy);
    }

    /** @test */
    public function decimal_spread_returns_correct_winner()
    {
        $game = SportsGame::factory()->make([
            'home_team_score' => 7,
            'away_team_score' => 8,
            'home_team_spread' => 1.5,
            'away_team_spread' => -1.5,
        ]);

        $this->assertTrue($game->homeCovered());
        $this->assertEquals($game->spreadWinner(), $game->homeTeam);
    }

    /** @test */
    public function homeCovered_is_spread_winner_if_spread_is_null()
    {
        $game = SportsGame::factory()->homeWins()->make();
        $this->assertNull($game->homeCovered());
        $this->assertSame($game->winner(), $game->spreadWinner());
    }

    /** @test */
    public function awayCovered_is_spread_winner_if_spread_is_null()
    {
        $game = SportsGame::factory()->awayWins()->make();
        $this->assertNull($game->awayCovered());
        $this->assertSame($game->winner(), $game->spreadWinner());
    }

    /** @test */
    public function homeCovered_returns_null_if_no_scores()
    {
        $game = SportsGame::factory()->make();
        $this->assertNull($game->homeCovered());
    }

    /** @test */
    public function homeCovered_returns_correctResult()
    {
        $scores = $this->testSpreads();
        foreach ($scores as $score) {
            $homeScore = $score[0];
            $awayScore = $score[1];
            $homeSpread = $score[2];
            $expectedValue = $score[3];
            $game = SportsGame::factory()->make([
                'home_team_score' => $homeScore,
                'away_team_score' => $awayScore,
                'home_team_spread' => $homeSpread,
                'away_team_spread' => $homeSpread * -1,
            ]);
            $this->assertEquals(
                $expectedValue,
                $game->homeCovered(),
                "home: $homeScore / away: $awayScore / spread: $homeSpread"
            );
        }
    }

    /** @test */
    public function awayCovered_returns_correct_result()
    {
        $scores = $this->testSpreads();
        foreach ($scores as $score) {
            $awayScore = $score[0];
            $homeScore = $score[1];
            $awaySpread = $score[2];
            $expectedValue = $score[3];
            $game = SportsGame::factory()->make([
                'away_team_score' => $awayScore,
                'home_team_score' => $homeScore,
                'away_team_spread' => $awaySpread,
                'home_team_spread' => $awaySpread * -1,
            ]);
            $this->assertEquals(
                $expectedValue,
                $game->awayCovered(),
                "away: $awayScore / home: $homeScore / spread: $awaySpread"
            );
        }
    }


    /** @test */
    public function winner_returns_null_if_there_are_no_scores()
    {
        $game = SportsGame::factory()->make();
        $this->assertNull($game->winner());
    }

    /** @test */
    public function winner_returns_null_if_tied()
    {
        $game = SportsGame::factory()->isTied()->make();
        $this->assertNull($game->winner());
    }

    /** @test */
    public function winner_returns_home_team_if_home_won()
    {
        $game = SportsGame::factory()->homeWins()->make();
        $this->assertEquals($game->homeTeam, $game->winner());
    }

    /** @test */
    public function winner_returns_away_team_if_away_won()
    {
        $game = SportsGame::factory()->awayWins()->make();
        $this->assertEquals($game->awayTeam, $game->winner());
    }

    /** @test */
    public function hasScores_returns_true_when_both_teams_have_scores()
    {
        $game = SportsGame::factory()->make([
            'home_team_score' => 10,
            'away_team_score' => 10
        ]);
        $this->assertTrue($game->hasScores());
    }

    /** @test */
    public function hasScores_returns_true_when_both_teams_have_0_points()
    {
        $game = SportsGame::factory()->make([
            'home_team_score' => 0,
            'away_team_score' => 0
        ]);
        $this->assertTrue($game->hasScores());
    }

    /** @test */
    public function hasScores_returns_false_when_home_score_is_null()
    {
        $game = SportsGame::factory()->make([
            'home_team_score' => null,
            'away_team_score' => 10
        ]);
        $this->assertFalse($game->hasScores());
    }

    /** @test */
    public function hasScores_returns_false_when_away_score_is_null()
    {
        $game = SportsGame::factory()->make([
            'home_team_score' => 10,
            'away_team_score' => null
        ]);
        $this->assertFalse($game->hasScores());
    }

    /** @test */
    public function isTie_returns_true_on_tie()
    {
        $game = SportsGame::factory()->isTied()->make();

        $this->assertTrue($game->isTie());
    }

    /** @test */
    public function isTie_returns_false_when_home_wins()
    {
        $game = SportsGame::factory()->homeWins()->make();
        $this->assertFalse($game->isTie());
    }

    /** @test */
    public function isTie_returns_false_when_away_wins()
    {
        $game = SportsGame::factory()->awayWins()->make();
        $this->assertFalse($game->isTie());
    }

    private function testSpreads() : array
    {
        return [
            // [ team A score, team B score, team A spread, expected Result ]
            [ 10, 7, 3, true ],
            [ 13, 7, 3, true ],
            [ 13, 7, -3, true ],
            [ 7, 10, 3, false ],
            [ 7, 13, 3, false ],
            [ 10, 7, -3, false ],
            [ 7, 10, -3, false ],
            [ 7, 13, -3, false ],
            [ 10, 7, 3.5, true ],
            [ 10, 7, -3.5, false ],
            [ 7, 8, 1.5, true ],
            [ 7, 7, 0, false ],
            [ 17, 17, 3, true ],
        ];
    }
}
