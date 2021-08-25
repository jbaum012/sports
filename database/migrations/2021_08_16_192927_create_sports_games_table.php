<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSportsGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sports_games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_group_id')->constrained();
            $table->foreignId('home_team_id')->constrained('sports_teams');
            $table->foreignId('away_team_id')->constrained('sports_teams');
            $table->foreignId('created_by')->constrained('users');
            $table->double('home_team_spread', 5, 2)->nullable();
            $table->double('away_team_spread', 5, 2)->nullable();
            $table->integer('home_team_score')->nullable();
            $table->integer('away_team_score')->nullable();
            $table->dateTime('starts_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sports_games');
    }
}
