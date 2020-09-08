<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->integer('home_team_score');
            $table->integer('away_team_score');
            $table->integer('week_number');
            $table->integer('spread');

            $table->foreignId('season_id')->constrained();
            $table->unsignedBigInteger('winner');
            $table->unsignedBigInteger('home_team_id');
            $table->unsignedBigInteger('away_team_id');
            $table->timestamps();

            $table->foreign('home_team_id')
                ->references('id')->on('teams')
                ->onDelete('cascade');
            $table->foreign('away_team_id')
                ->references('id')->on('teams')
                ->onDelete('cascade');
            $table->foreign('winner')
                ->references('id')->on('teams')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
