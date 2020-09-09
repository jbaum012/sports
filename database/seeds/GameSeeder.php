<?php

use App\Team;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // game 1
        factory('App\Game')->create([
            'season_id' => 1,
            'starts_at' => Carbon::create('2020', '09', '10', '19', '30'),
            'home_team_id' => Team::firstWhere('nickname', 'Chiefs')->id,
            'away_team_id' => Team::firstWhere('nickname', 'Texans')->id,
            'spread' => 9.5,
            'spread_team_id' => Team::firstWhere('nickname', 'Chiefs')->id,
        ]);
        // game 2
        factory('App\Game')->create([
            'season_id' => 1,
            'starts_at' => Carbon::create('2020', '09', '13', '12', '00'),
            'home_team_id' => Team::firstWhere('nickname', 'Bills')->id,
            'away_team_id' => Team::firstWhere('nickname', 'Jets')->id,
            'spread' => 6.5,
            'spread_team_id' => Team::firstWhere('nickname', 'Bills')->id,
        ]);
        // game 1
        factory('App\Game')->create([
            'season_id' => 1,
            'starts_at' => Carbon::create('2020', '09', '13', '12', '00'),
            'home_team_id' => Team::firstWhere('nickname', 'Vikings')->id,
            'away_team_id' => Team::firstWhere('nickname', 'Packers')->id,
            'spread' => 2.5,
            'spread_team_id' => Team::firstWhere('nickname', 'Vikings')->id,
        ]);
        // game 1
        factory('App\Game')->create([
            'season_id' => 1,
            'starts_at' => Carbon::create('2020', '09', '13', '12', '00'),
            'home_team_id' => Team::firstWhere('nickname', 'Washington')->id,
            'away_team_id' => Team::firstWhere('nickname', 'Eagles')->id,
            'spread' => 6,
            'spread_team_id' => Team::firstWhere('nickname', 'Eagles')->id
        ]);
        // game 1
        factory('App\Game')->create([
            'season_id' => 1,
            'starts_at' => Carbon::create('2020', '09', '13', '12', '00'),
            'home_team_id' => Team::firstWhere('nickname', 'Ravens')->id,
            'away_team_id' => Team::firstWhere('nickname', 'Browns')->id,
            'spread' => 8,
            'spread_team_id' => Team::firstWhere('nickname', 'Ravens')->id
        ]);
        // game 1
        factory('App\Game')->create([
            'season_id' => 1,
            'starts_at' => Carbon::create('2020', '09', '13', '12', '00'),
            'home_team_id' => Team::firstWhere('nickname', 'Jaguars')->id,
            'away_team_id' => Team::firstWhere('nickname', 'Colts')->id,
            'spread' => 7.5,
            'spread_team_id' => Team::firstWhere('nickname', 'Colts')->id,
        ]);
        // game 1
        factory('App\Game')->create([
            'season_id' => 1,
            'starts_at' => Carbon::create('2020', '09', '13', '12', '00'),
            'home_team_id' => Team::firstWhere('nickname', 'Panthers')->id,
            'away_team_id' => Team::firstWhere('nickname', 'Raiders')->id,
            'spread' => 2.5,
            'spread_team_id' => Team::firstWhere('nickname', 'Raiders')->id,
        ]);
        // game 1
        factory('App\Game')->create([
            'season_id' => 1,
            'starts_at' => Carbon::create('2020', '09', '13', '12', '00'),
            'home_team_id' => Team::firstWhere('nickname', 'Lions')->id,
            'away_team_id' => Team::firstWhere('nickname', 'Bears')->id,
            'spread' => 3,
            'spread_team_id' => Team::firstWhere('nickname', 'Lions')->id,
        ]);
        // game 1
        factory('App\Game')->create([
            'season_id' => 1,
            'starts_at' => Carbon::create('2020', '09', '13', '12', '00'),
            'home_team_id' => Team::firstWhere('nickname', 'Falcons')->id,
            'away_team_id' => Team::firstWhere('nickname', 'Seahawks')->id,
            'spread' => 1.5,
            'spread_team_id' => Team::firstWhere('nickname', 'Seahawks')->id,
        ]);
        // game 1
        factory('App\Game')->create([
            'season_id' => 1,
            'starts_at' => Carbon::create('2020', '09', '13', '12', '00'),
            'home_team_id' => Team::firstWhere('nickname', 'Patriots')->id,
            'away_team_id' => Team::firstWhere('nickname', 'Dolphins')->id,
            'spread' => 6,
            'spread_team_id' => Team::firstWhere('nickname', 'Patriots')->id,
        ]);
        // game 1
        factory('App\Game')->create([
            'season_id' => 1,
            'starts_at' => Carbon::create('2020', '09', '13', '14', '05'),
            'home_team_id' => Team::firstWhere('nickname', 'Bengals')->id,
            'away_team_id' => Team::firstWhere('nickname', 'Chargers')->id,
            'spread' => 3,
            'spread_team_id' => Team::firstWhere('nickname', 'Chargers')->id,
        ]);
        // game 1
        factory('App\Game')->create([
            'season_id' => 1,
            'starts_at' => Carbon::create('2020', '09', '13', '14', '25'),
            'home_team_id' => Team::firstWhere('nickname', '49ers')->id,
            'away_team_id' => Team::firstWhere('nickname', 'Cardinals')->id,
            'spread' => 7,
            'spread_team_id' => Team::firstWhere('nickname', '49ers')->id,
        ]);
        // game 1
        factory('App\Game')->create([
            'season_id' => 1,
            'starts_at' => Carbon::create('2020', '09', '13', '14', '25'),
            'home_team_id' => Team::firstWhere('nickname', 'Saints')->id,
            'away_team_id' => Team::firstWhere('nickname', 'Buccaneers')->id,
            'spread' => 3.5,
            'spread_team_id' => Team::firstWhere('nickname', 'Saints')->id,
        ]);
        // game 1
        factory('App\Game')->create([
            'season_id' => 1,
            'starts_at' => Carbon::create('2020', '09', '13', '19', '20'),
            'home_team_id' => Team::firstWhere('nickname', 'Rams')->id,
            'away_team_id' => Team::firstWhere('nickname', 'Cowboys')->id,
            'spread' => 2.5,
            'spread_team_id' => Team::firstWhere('nickname', 'Cowboys')->id,
        ]);
        // game 1
        factory('App\Game')->create([
            'season_id' => 1,
            'starts_at' => Carbon::create('2020', '09', '14', '18', '10'),
            'home_team_id' => Team::firstWhere('nickname', 'Giants')->id,
            'away_team_id' => Team::firstWhere('nickname', 'Steelers')->id,
            'spread' => 4.5,
            'spread_team_id' => Team::firstWhere('nickname', 'Steelers')->id,
        ]);
        factory('App\Game')->create([
            'season_id' => 1,
            'starts_at' => Carbon::create('2020', '09', '14', '21', '20'),
            'home_team_id' => Team::firstWhere('nickname', 'Broncos')->id,
            'away_team_id' => Team::firstWhere('nickname', 'Titans')->id
        ]);
    }
}
