<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use App\Models\GameGroup;
use App\Models\SportsBet;
use App\Models\SportsGame;
use App\Models\SportsTeam;
use Illuminate\Testing\TestResponse;
use App\Repositories\SportsBetRepository;
use App\Repositories\SportsGameRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Exceptions\PlaceBetAfterGameStartsException;

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
    public function changing_bet_after_starts_throws_error()
    {
        $this->withoutExceptionHandling();
        $this->expectException(PlaceBetAfterGameStartsException::class);
        $user = User::factory()->create();
        $game = SportsGame::factory()->homeWins()->create([
            'starts_at' => Carbon::now()
        ]);
        $originalPick = $game->home_team_id;
        $bet = $this->repo->findByUserAndGame($user->id, $game->id);
        $bet->sports_team_id = $game->home_team_id;
        $bet->save();
        $pick = [
            'sports_team_id' => $game->away_team_id,
        ];

        $this->asUser()->put("api/bets/{$bet->id}/pick", $pick);

        $bet = SportsBet::find($bet->id);
        $this->assertEquals($originalPick, $bet->sports_team_id);
    }

    /** @test */
    public function can_double_down()
    {
        $user = User::factory()->create();
        $bet = SportsBet::factory()->hasPick($user->id)->create();
        $this->asUser()
            ->post("api/bets/{$bet->id}/double")
            ->assertOk();
        $dbBet = SportsBet::find($bet->id);
        $this->assertTrue($dbBet->doubled);
    }

    /** @test */
    public function can_submit_pick()
    {
        $user = User::factory()->create();
        $game = SportsGame::factory()->create([
            'starts_at' => Carbon::tomorrow()
        ]);
        $bet = $this->repo->findByUserAndGame($user->id, $game->id);
        $pick = [
            'sports_team_id' => $game->home_team_id,
        ];
        $this->asUser()
            ->put("api/bets/{$bet->id}/pick", $pick)
            ->assertOk();
        $bet = SportsBet::find($bet->id);
        $this->assertEquals($pick['sports_team_id'], $bet->sports_team_id);
    }

    /** @test */
    public function can_get_unpicked_games()
    {
        $unpicked = 5;
        $missed = 3;
        $old = 2;
        $user = User::factory()->create();
        $missedGame = SportsGame::factory()->count($missed)->create([
            'starts_at' => Carbon::now()->addWeeks(-2)
        ]);
        $pick = SportsBet::factory()->hasPick($user->id)->count($old)->create();
        $unpickedGames = SportsGame::factory()->count($unpicked)->create([
            'starts_at' => Carbon::now()->addWeek()
        ]);
        $reponse = $this->asUser()
            ->get('api/bets/unpicked')
            ->assertOk()
            ->assertJsonCount($unpicked);
    }
}
