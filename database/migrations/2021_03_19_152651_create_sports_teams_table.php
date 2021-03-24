<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSportsTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sports_teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('division', [
                'NFC West',
                'NFC South',
                'NFC East',
                'NFC North',
                'AFC West',
                'AFC South',
                'AFC East',
                'AFC North',
            ]);
            $table->string('location');
            $table->string('abbreviation');
            $table->string('primary_color');
            $table->string('secondary_color');
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
        Schema::dropIfExists('sports_teams');
    }
}
