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
        $response = $this->asUser()->get('/teams');
        $response->assertOK()
            ->assertSee($team->name);
    }

    /** @test */
    public function show_success()
    {
        $team = SportsTeam::factory()->create();
        $response = $this->asUser()->get("/team/{$team->id}");
        $response->assertOk()
            ->assertSee($team->name)
            ->assertSee($team->location)
            ->assertSee($team->abbreviation)
            ->assertSee($team->division)
            ->assertSee($team->primary_color)
            ->assertSee($team->seconary_color);
    }
}
