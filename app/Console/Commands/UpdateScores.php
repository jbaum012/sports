<?php

namespace App\Console\Commands;

use App\Models\SportsGame;
use Illuminate\Console\Command;
use App\Events\SportsGames\SportsGameScoresUpdated;

class UpdateScores extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:scores';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Trigger the scores updated event on all games with scores';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $games = SportsGame::all();
        foreach ($games as $game) {
            if ($game->hasScores()) {
                SportsGameScoresUpdated::dispatch($game);
            }
        }
        return "Scores Updated";
    }
}
