<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('starts_at');
            $table->integer('score_card_cost');
            $table->integer('max_double_down');
            $table->timestamps();
        });
        factory('App\Season')->create([
            'name' => '2020 NFL',
            'starts_at' => Carbon::create('2020', '09', '08'),
            'score_card_cost' => 200,
            'max_double_down' => 2
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seasons');
    }
}
