<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\SportsTeam;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SportsTeamTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index_success()
    {
        $team = SportsTeam::factory()->create();
        $response = $this->asUser()->get("/teams");
        $response->assertOk()
            ->assertSee($team->name);
    }

    /** @test */
    public function show_success()
    {
        $team = SportsTeam::factory()->create();
        $t = new SportsTeam();
        $response = $this->asUser()->get("/team/{$team->id}");
        $response->assertOk()
            ->assertSee($team->name);
    }
}
