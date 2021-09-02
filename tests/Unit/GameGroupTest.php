<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\GameGroup;
use App\Models\SportsGame;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GameGroupTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function userBets_returns_bets_grouped_by_user()
    {
        $group = GameGroup::factory()->create();
        $users = User::factory()->count(5)->create();
        $games = SportsGame::factory()->count(5)->create([
            'game_group_id' => $group->id,
            'created_by' => $users[0]->id
        ]);
        $group->fresh();
        $this->assertCount(5, $group->userBets());
        $this->assertCount(5, $group->userBets()->first());
    }
}
