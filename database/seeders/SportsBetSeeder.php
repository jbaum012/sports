<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\SportsBet;
use App\Models\SportsGame;
use Illuminate\Database\Seeder;

class SportsBetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $games = SportsGame::all();
        foreach ($users as $user) {
            foreach ($games as $game) {
                $bet = SportsBet::firstOrCreate(
                    [
                    'user_id' => $user->id,
                    'sports_game_id' => $game->id,
                    'game_group_id' => $game->game_group_id
                ],
                    [
                    'doubled' => false
                ]
                );
            }
        }
    }
}
