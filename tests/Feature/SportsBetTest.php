<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use App\Models\SportsBet;
use App\Models\SportsGame;
use Illuminate\Testing\TestResponse;
use App\Repositories\SportsBetRepository;
use Illuminate\Foundation\Testing\WithFaker;
use App\Events\SportsGames\SportsGameCreated;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SportsBetTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function unplaced_bets_returns_correct_number_of_bets()
    {
        $repo = new SportsBetRepository();
        $user = User::factory()->create();
        $games = SportsGame::factory()->count(5)->create([
            'starts_at' => Carbon::create(9999, 1, 1)
        ]);
        SportsGame::factory()->count(5)->homeWins()->create();
        $this->assertDatabaseCount(SportsBet::class, 10);
        $result = $repo->getUnplacedBets($user->id);
        $this->assertCount($games->count(), $result);
    }

    /** @test */
    public function create_bet_for_all_users_on_game_created()
    {
        $users = User::factory()->count(5)->create();
        $this->actingAs($users[0]);
        $this->storeGame();
        $this->assertDatabaseCount(SportsBet::class, 5);
    }

    /** @test */
    public function bets_are_created_when_user_is_created()
    {
        $games = SportsGame::factory()->count(5)->create();
        $user = User::factory()->create();
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
