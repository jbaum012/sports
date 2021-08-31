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
use Illuminate\Foundation\Testing\RefreshDatabase;

class SportsBetTest extends TestCase
{
    use RefreshDatabase;

    private SportsBetRepository $repo;

    public function setUp(): void
    {
        parent::setUp();
        $this->repo = new SportsBetRepository();
    }

    /** @test */
    public function can_submit_pick()
    {
        $user = User::factory()->create();
        $game = SportsGame::factory()->create();
        $bet = $this->repo->findByUserAndGame($user->id, $game->id);
        $pick = [
            'sports_team_id' => $game->home_team_id,
        ];
        $this->asUser()
            ->post("api/bets/{$bet->id}/pick", $pick)
            ->assertOk();
        $bet = SportsBet::find($bet->id);
        $this->assertEquals($pick['sports_team_id'], $bet->sports_team_id);
    }
}
