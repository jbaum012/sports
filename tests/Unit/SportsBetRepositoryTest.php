<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use App\Models\GameGroup;
use App\Models\SportsBet;
use App\Models\SportsGame;
use App\Exceptions\DuplicateBetException;
use App\Repositories\SportsBetRepository;
use Database\Factories\SportsGameFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Exceptions\DoubleDownLimitReachedException;

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
    public function double_down_on_more_than_two_games_per_group_throws_exception()
    {
        $this->expectException(DoubleDownLimitReachedException::class);
        $user = User::factory()->create();
        $group = GameGroup::factory()->create();
        $bets = SportsBet::factory()->hasPick($user->id)->count(2)->create([
            'game_group_id' => $group->id,
            'doubled' => true
        ]);
        $bet = SportsBet::factory()->hasPick($user->id)->create([
            'game_group_id' => $group->id,
            'doubled' => false
        ]);
        $this->repo->updateDoubled($bet, true);
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
    public function unpicked_bets_returns_correct_number_of_bets()
    {
        $hasScores = 3;
        $unplayedAndUnpicked = 2;
        $unplayedHasPicks = 1;
        $user = User::factory()->create();
        SportsGame::factory()->count($hasScores)->homeWins()->create([
            'created_by' => $user->id
        ]);

        $hasPicks = SportsBet::factory()
            ->hasPick($user->id)
            ->count($unplayedHasPicks)
            ->create();

        $games = SportsGame::factory()->count($unplayedAndUnpicked)->create([
            'starts_at' => Carbon::create(9999, 1, 1),
            'created_by' => $user->id
        ]);

        $result = $this->repo->getUnpickedBets($user->id);
        $this->assertCount($games->count(), $result);
    }
}
