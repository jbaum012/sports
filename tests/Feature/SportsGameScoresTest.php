<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\SportsGame;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SportsGameScoresTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function update_scores_success()
    {
        $this->withoutExceptionHandling();

        $game = SportsGame::factory()->create();
        $data = [
            'home_team_score' => 1,
            'away_team_score' => 1
        ];
        $this->asUser();
        $this->put("games/{$game->id}/scores", $data)
            ->assertStatus(302); // redirect back to show page
        $updatedGame = SportsGame::find($game->id);
        $this->assertEquals($data['home_team_score'], $updatedGame->home_team_score);
        $this->assertEquals($data['away_team_score'], $updatedGame->away_team_score);
    }

    /** @test */
    public function clear_scores_success()
    {
        $game = SportsGame::factory()->homeWins()->create();
        $this->asUser();
        $this->delete("games/{$game->id}/scores")
            ->assertStatus(302); // redirect back to show page
        $updatedGame = SportsGame::find($game->id);
        $this->assertNull($updatedGame->home_team_score);
        $this->assertNull($updatedGame->away_team_score);
    }
}
