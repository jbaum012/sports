<?php

namespace Tests\Feature;

use App\Models\GameGroup;
use Tests\TestCase;
use App\Models\SportsGame;
use App\Models\SportsTeam;
use Inertia\Testing\Assert;
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

    /** @test */
    public function update_success()
    {
        $this->assertDatabaseCount(SportsGame::class, 0);
        $gameData = SportsGame::factory()->create();
        $newData = SportsGame::factory()->homeWins()->raw([
            'home_team_spread' => 1,
            'away_team_spread' => -1,
        ]);
        $newGroup = GameGroup::find($newData['game_group_id']);
        $response = $this->put("games/{$gameData->id}", $newData);
        $response->assertOk()
            ->assertInertia(
                fn (Assert $page) => $page
                ->component('SportsGames/SportsGameShow')
                ->has(
                    'game',
                    fn (Assert $page) => $page
                    ->where('group', $newGroup->label)
                    ->where('home_team.id', $newData['home_team_id'])
                    ->where('away_team.id', $newData['away_team_id'])
                    ->where('home_team_spread', $newData['home_team_spread'])
                    ->where('away_team_spread', $newData['away_team_spread'])
                    ->where('starts_at', $newData['starts_at']->format(DATE_ATOM))
                    ->etc()
                )
            );
        $this->assertDatabaseCount(SportsGame::class, 1);
    }
}
