<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\SportsTeam;
use Inertia\Testing\Assert;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SportsTeamTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setup();
    }

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
        $this->asUser()
            ->get("/teams/{$team->name}")
            ->assertOk()
            ->assertSee($team->id)
            ->assertSee($team->name)
            ->assertSee($team->location)
            ->assertSee($team->abbreviation)
            ->assertSee($team->division)
            ->assertSee($team->primary_color)
            ->assertSee($team->seconary_color);
    }

    /** @test */
    public function store_success()
    {
        $teamData = SportsTeam::factory()->raw();
        $this->asUser()->post("/teams", $teamData)
            ->assertOk()
            ->assertInertia(
                fn (Assert $page) => $page
                ->component('SportsTeams/SportsTeamShow')
                ->has(
                    'team',
                    fn (Assert $page) => $page
                    ->where('name', $teamData['name'])
                    ->where('location', $teamData['location'])
                    ->where('abbreviation', $teamData['abbreviation'])
                    ->where('division', $teamData['division'])
                    ->where('primary_color', $teamData['primary_color'])
                    ->where('secondary_color', $teamData['secondary_color'])
                    ->etc()
                )
            );
        $this->assertDatabaseHas(SportsTeam::class, $teamData);
        $this->assertCount(1, SportsTeam::all());
    }
    /** @test */
    public function update_success()
    {
        $teamData = SportsTeam::factory()->create();
        $newData = SportsTeam::factory()->raw();

        $this->asUser()->put("/teams/{$teamData->name}", $newData)
            ->assertOK()
            ->assertInertia(
                fn (Assert $page) => $page
                ->component('SportsTeams/SportsTeamShow')
                ->has(
                    'team',
                    fn (Assert $page) => $page
                    ->where('id', $teamData['id'])
                    ->where('name', $newData['name'])
                    ->where('location', $newData['location'])
                    ->where('abbreviation', $newData['abbreviation'])
                    ->where('division', $newData['division'])
                    ->where('primary_color', $newData['primary_color'])
                    ->where('secondary_color', $newData['secondary_color'])
                    ->etc()
                )
            );
        $this->assertDatabaseHas(SportsTeam::class, $newData);
        $this->assertCount(1, SportsTeam::all());
    }
}
