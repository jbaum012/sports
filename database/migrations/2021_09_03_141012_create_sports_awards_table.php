<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSportsAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('award_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('icon');
            $table->string('tailwind_class');
            $table->timestamps();
        });
        Schema::create('sports_awards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('award_type_id')->constrained('award_types');
            $table->foreignId('game_group_id')->constrained('game_groups');
            $table->foreignId('sports_bet_id')->constrained('sports_bets');
            $table->foreignId('user_id')->constrained('users');
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
        Schema::dropIfExists('sports_awards');
    }
}
