<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Season')->create([
            'name' => '2020 NFL',
            'starts_at' => Carbon::create('2020', '09', '10'),
            'score_card_cost' => 200,
            'max_double_down' => 2
        ]);
    }
}
