<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\SportsGame;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SportsGameTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setup();
        $this->asUser();
    }

    /** @test */
    public function index_success()
    {
        $game = SportsGame::factory()->create();
        $this->get('/games')
            ->assertSee($game->homeTeam->name)
            ->assertSee($game->awayTeam->name);
    }

    /** @test */
    public function store_success()
    {
        $game = SportsGame::factory()->make();
        $this->post('/games', $game->toArray())
            ->assertSee($game->id);
    }
}
