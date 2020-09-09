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
            $table->dateTime('starts_at');
            $table->integer('home_team_score')->nullable();
            $table->integer('away_team_score')->nullable();
            $table->decimal('spread', 5, 1)->nullable();

            $table->foreignId('season_id')->constrained();
            $table->unsignedBigInteger('home_team_id');
            $table->unsignedBigInteger('away_team_id');
            $table->unsignedBigInteger('spread_team_id')->nullable();
            $table->timestamps();

            $table->foreign('home_team_id')
                ->references('id')->on('teams')
                ->onDelete('cascade');
            $table->foreign('away_team_id')
                ->references('id')->on('teams')
                ->onDelete('cascade');
            $table->foreign('spread_team_id')
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
