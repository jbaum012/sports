<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\GameGroup;
use App\Models\SportsBet;
use App\Models\SportsGame;
use App\Repositories\ResultsRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResultsRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public ResultsRepository $repo;

    public function setup(): void
    {
        parent::setup();
        $this->repo = new ResultsRepository();
    }

    /** @test */
    public function get_results_for_group_returns_total_scores()
    {
        $group = GameGroup::factory()->create();
        $users = User::factory()->count(5)->create();
        foreach ($users as $user) {
            $bet = SportsBet::factory()->hasPick($user->id, $wins = false)->create([
                'game_group_id' => $group->id
            ]);
        }
        $results = $this->repo->getResultsForGroup($group->id);
        $this->assertCount(5, $results);
    }

    /** @test */
    public function get_winners_for_group_returns_correct_winner()
    {
        $group = GameGroup::factory()->create();
        $losers = User::factory()->count(5)->create();
        $winner = User::factory()->create();
        foreach ($losers as $user) {
            $bet = SportsBet::factory()->hasPick($user->id, $wins = false)->create([
                'game_group_id' => $group->id
            ]);
        }
        $wonBet = SportsBet::factory()->hasPick($winner->id, $wins = true)->create([
            'game_group_id' => $group->id
        ]);
        $results = $this->repo->getWinnersForGroup($group->id);
        $this->assertCount(1, $results);
        $this->assertEquals($winner->id, $results[0]->id);
    }
}