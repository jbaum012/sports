<?php

namespace Tests\Unit;

use App\Exceptions\DuplicateBetException;
use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use App\Models\SportsBet;
use App\Models\SportsGame;
use App\Repositories\SportsBetRepository;
use Database\Factories\SportsGameFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SportsBetRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public SportsBetRepository $repo;

    public function setup(): void
    {
        parent::setup();
        $this->repo = new SportsBetRepository();
    }

    /** @test */
    public function creating_duplicate_bet_throws_error()
    {
        $this->expectException(DuplicateBetException::class);
        $data = SportsBet::factory()->raw();
        $bet = $this->repo->create($data);
        $throwsError = $this->repo->create($data);
    }

    /** @test */
    public function can_get_single_bet_by_providing_game_id_and_user_id()
    {
        $user = User::factory()->create();
        $game = SportsGame::factory()->create();
        $bet = $this->repo->findByUserAndGame($user->id, $game->id);
        $this->assertNotNull($bet);
    }

    /** @test */
    public function unplaced_bets_returns_correct_number_of_bets()
    {
        $user = User::factory()->create();
        $games = SportsGame::factory()->count(5)->create([
            'starts_at' => Carbon::create(9999, 1, 1),
            'created_by' => $user->id
        ]);
        SportsGame::factory()->count(5)->homeWins()->create([
            'created_by' => $user->id
        ]);
        $this->assertDatabaseCount(SportsBet::class, 10);
        $result = $this->repo->getUnplacedBets($user->id);
        $this->assertCount($games->count(), $result);
    }
}
