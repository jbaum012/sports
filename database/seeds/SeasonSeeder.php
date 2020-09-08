<?php

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
            'score_card_cost' => 200,
            'max_double_down' => 2
        ]);
    }
}
