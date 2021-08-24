<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSportsBetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sports_bets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_group_id')
                ->constrained('game_groups')
                ->cascadeOnDelete();
            $table->foreignId('sports_game_id')->constrained('sports_games');
            $table->foreignId('sports_team_id')
                ->nullable()
                ->constrained('sports_teams');
            $table->foreignId('user_id')->constrained('users');
            $table->boolean('doubled');
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
        Schema::dropIfExists('sports_bets');
    }
}
