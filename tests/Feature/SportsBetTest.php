<?php

namespace Tests\Feature;

use App\Events\SportsGames\SportsGameCreated;
use App\Models\SportsBet;
use Tests\TestCase;
use App\Models\User;
use App\Models\SportsGame;
use Illuminate\Testing\TestResponse;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SportsBetTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_bet_for_all_users_on_game_created()
    {
        $this->withoutExceptionHandling();

        $users = User::factory()->count(5)->create();
        $this->actingAs($users[0]);
        $this->storeGame();
        $this->assertDatabaseCount(SportsBet::class, 5);
    }

    /** @test */
    public function bets_are_created_when_user_is_created()
    {
        $user = User::factory()->create();
        $games = SportsGame::factory()->count(5)->create();
        event('eloquent.created: App\User', $user);
        $this->assertDatabaseCount(SportsBet::class, 5);
    }

    private function storeGame() : TestResponse
    {
        $game = SportsGame::factory()->raw();
        return $this->post('/games', $game)
            ->assertOk();
    }
}