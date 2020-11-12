<?php

use App\Bet;
use App\Game;
use App\Week;
use App\Season;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeekTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weeks', function (Blueprint $table) {
            $table->id();
            $table->date('starts');
            $table->integer('number');
            $table->timestamps();
        });

        Schema::table('bets', function (Blueprint $table) {
            $table->foreignId('week_id');
        });
        Schema::table('games', function (Blueprint $table) {
            $table->foreignId('week_id');
        });

        $weekNumber = 1;
        $week = Season::first()->starts_at;
        $games = Game::with('bets')->get();

        while ($weekNumber < 10) {
            $gameWeek = new Week();
            $gameWeek->starts = $week;
            $gameWeek->number = $weekNumber;
            $gameWeek->save();

            foreach ($games as $game) {
                $game->week_id = $game->findWeek();
                $game->save();
                foreach ($game->bets as $bet) {
                    $bet->week_id = $game->week_id;
                    $bet->save();
                }
            }

            $weekNumber++;
            $week = $week->addWeeks(1);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('week');
    }
}
