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
            'starts_at' => Carbon::create(9999, 1, 1),
            'created_by' => $user->id
        ]);
        SportsGame::factory()->count(5)->homeWins()->create([
            'created_by' => $user->id
        ]);
        $this->assertDatabaseCount(SportsBet::class, 10);
        $result = $repo->getUnplacedBets($user->id);
        $this->assertCount($games->count(), $result);
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
