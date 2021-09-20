<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\SportsBet;
use App\Models\SportsGame;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SportsBetTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function doubled_bet_doubls_points()
    {
        $user = User::factory()->create();
        $game = SportsGame::factory()->homeWins()->create();
        $bet = SportsBet::factory()->create([
            'sports_game_id' => $game->id,
            'sports_team_id' => $game->home_team_id,
            'user_id' => $user->id,
            'doubled' => true
        ]);

        $this->assertEquals(SportsBet::BASE_VALUE * 2, $bet->points());
    }

    /** @test */
    public function split_bet_returns_0_points()
    {
        $user = User::factory()->create();
        $game = SportsGame::factory()->create([
            'home_team_score' => 11,
            'away_team_score' => 14,
            'home_team_spread' => 3,
            'away_team_spread' => -3
        ]);
        $bet = SportsBet::factory()->create([
            'sports_game_id' => $game->id,
            'sports_team_id' => $game->home_team_id,
            'user_id' => $user->id
        ]);

        $this->assertEquals(0, $bet->points());
    }

    /** @test */
    public function bonus_points_only_applied_to_creators_bet()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $this->actingAs($user);
        $game = SportsGame::factory()->homeWins()->create();
        $bet = SportsBet::factory()->create([
            'sports_game_id' => $game->id,
            'sports_team_id' => $game->home_team_id,
            'user_id' => $otherUser->id
        ]);

        $expeced = SportsBet::BASE_VALUE;
        $this->assertEquals($expeced, $bet->points());
    }

    /** @test */
    public function bonus_points_applied_to_creators_won_bet()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $game = SportsGame::factory()->homeWins()->create();
        $bet = SportsBet::factory()->create([
            'sports_game_id' => $game->id,
            'sports_team_id' => $game->home_team_id,
            'user_id' => $user->id
        ]);

        $expeced = SportsBet::BASE_VALUE + SportsBet::CREATOR_BONUS;
        $this->assertEquals($expeced, $bet->points());
    }

    /** @test */
    public function bonus_points_applied_to_creators_lost_bet()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $game = SportsGame::factory()->awayWins()->create();
        $bet = SportsBet::factory()->create([
            'sports_game_id' => $game->id,
            'sports_team_id' => $game->home_team_id,
            'user_id' => $user->id
        ]);

        $expeced = -SportsBet::BASE_VALUE + SportsBet::CREATOR_BONUS;
        $this->assertEquals($expeced, $bet->points());
    }

    /** @test */
    public function lost_bet_returns_correct_points()
    {
        $game = SportsGame::factory()->awayWins()->create();
        $bet = SportsBet::factory()->create([
            'sports_game_id' => $game->id,
            'sports_team_id' => $game->home_team_id,
        ]);
        $this->assertEquals(-SportsBet::BASE_VALUE, $bet->points());
    }

    /** @test */
    public function won_bet_returns_correct_points()
    {
        $game = SportsGame::factory()->homeWins()->create();
        $bet = SportsBet::factory()->create([
            'sports_game_id' => $game->id,
            'sports_team_id' => $game->home_team_id,
        ]);
        $this->assertEquals(SportsBet::BASE_VALUE, $bet->points());
    }

    /** @test */
    public function won_returns_true_if_spread_winner_equals_team_id()
    {
        $game = SportsGame::factory()->homeWins()->create();
        $bet = SportsBet::factory()->create([
            'sports_game_id' => $game->id,
            'sports_team_id' => $game->home_team_id,
        ]);
        $this->assertTrue($bet->won());
    }

    /** @test */
    public function bets_are_created_on_game_created()
    {
        $users = User::factory()->count(5)->create();
        SportsGame::factory()->create([
            'created_by' => $users[0]->id
        ]);
        $this->assertDatabaseCount(SportsBet::class, 5);
    }

    /** @test */
    public function bets_are_created_on_user_created()
    {
        $user = User::factory()->create();
        $newGames = 5;
        $expectedUsers = 2;
        $expectedBets = $newGames * $expectedUsers;
        $games = SportsGame::factory()->count($newGames)->create([
            'created_by' => $user->id
        ]);
        $newUser = User::factory()->create();
        $this->assertDatabaseCount(SportsBet::class, $expectedBets);
    }
}
