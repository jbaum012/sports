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
            'spread' => 0,
            'home_team_id' => Team::firstWhere('name', 'like', '%Chiefs')->id,
            'away_team_id' => Team::firstWhere('name', 'like', '%Texans')->id
        ]);
        // game 2
        factory('App\Game')->create([
            'season_id' => 1,
            'starts_at' => Carbon::create('2020', '09', '13', '12', '00'),
            'spread' => 0,
            'home_team_id' => Team::firstWhere('name', 'like', '%Bills')->id,
            'away_team_id' => Team::firstWhere('name', 'like', '%Jets')->id
        ]);
        // game 1
        factory('App\Game')->create([
            'season_id' => 1,
            'starts_at' => Carbon::create('2020', '09', '13', '12', '00'),
            'spread' => 0,
            'home_team_id' => Team::firstWhere('name', 'like', '%Vikings')->id,
            'away_team_id' => Team::firstWhere('name', 'like', '%Packers')->id
        ]);
        // game 1
        factory('App\Game')->create([
            'season_id' => 1,
            'starts_at' => Carbon::create('2020', '09', '13', '12', '00'),
            'spread' => 0,
            'home_team_id' => Team::firstWhere('name', 'like', '%Team')->id,
            'away_team_id' => Team::firstWhere('name', 'like', '%Eagles')->id
        ]);
        // game 1
        factory('App\Game')->create([
            'season_id' => 1,
            'starts_at' => Carbon::create('2020', '09', '13', '12', '00'),
            'spread' => 0,
            'home_team_id' => Team::firstWhere('name', 'like', '%Ravens')->id,
            'away_team_id' => Team::firstWhere('name', 'like', '%Browns')->id
        ]);
        // game 1
        factory('App\Game')->create([
            'season_id' => 1,
            'starts_at' => Carbon::create('2020', '09', '13', '12', '00'),
            'spread' => 0,
            'home_team_id' => Team::firstWhere('name', 'like', '%Jaguars')->id,
            'away_team_id' => Team::firstWhere('name', 'like', '%Colts')->id
        ]);
        // game 1
        factory('App\Game')->create([
            'season_id' => 1,
            'starts_at' => Carbon::create('2020', '09', '13', '12', '00'),
            'spread' => 0,
            'home_team_id' => Team::firstWhere('name', 'like', '%Panthers')->id,
            'away_team_id' => Team::firstWhere('name', 'like', '%Raiders')->id
        ]);
        // game 1
        factory('App\Game')->create([
            'season_id' => 1,
            'starts_at' => Carbon::create('2020', '09', '13', '12', '00'),
            'spread' => 0,
            'home_team_id' => Team::firstWhere('name', 'like', '%Lions')->id,
            'away_team_id' => Team::firstWhere('name', 'like', '%Bears')->id
        ]);
        // game 1
        factory('App\Game')->create([
            'season_id' => 1,
            'starts_at' => Carbon::create('2020', '09', '13', '12', '00'),
            'spread' => 0,
            'home_team_id' => Team::firstWhere('name', 'like', '%Falcons')->id,
            'away_team_id' => Team::firstWhere('name', 'like', '%Seahawks')->id
        ]);
        // game 1
        factory('App\Game')->create([
            'season_id' => 1,
            'starts_at' => Carbon::create('2020', '09', '13', '12', '00'),
            'spread' => 0,
            'home_team_id' => Team::firstWhere('name', 'like', '%Patriots')->id,
            'away_team_id' => Team::firstWhere('name', 'like', '%Dolphins')->id
        ]);
        // game 1
        factory('App\Game')->create([
            'season_id' => 1,
            'starts_at' => Carbon::create('2020', '09', '13', '14', '05'),
            'spread' => 0,
            'home_team_id' => Team::firstWhere('name', 'like', '%Bengals')->id,
            'away_team_id' => Team::firstWhere('name', 'like', '%Chargers')->id
        ]);
        // game 1
        factory('App\Game')->create([
            'season_id' => 1,
            'starts_at' => Carbon::create('2020', '09', '13', '14', '25'),
            'spread' => 0,
            'spread' => 0,
            'home_team_id' => Team::firstWhere('name', 'like', '%49ers')->id,
            'away_team_id' => Team::firstWhere('name', 'like', '%Cardinals')->id
        ]);
        // game 1
        factory('App\Game')->create([
            'season_id' => 1,
            'starts_at' => Carbon::create('2020', '09', '13', '14', '25'),
            'spread' => 0,
            'home_team_id' => Team::firstWhere('name', 'like', '%Saints')->id,
            'away_team_id' => Team::firstWhere('name', 'like', '%Buccaneers')->id
        ]);
        // game 1
        factory('App\Game')->create([
            'season_id' => 1,
            'starts_at' => Carbon::create('2020', '09', '13', '19', '20'),
            'spread' => 0,
            'home_team_id' => Team::firstWhere('name', 'like', '%Rams')->id,
            'away_team_id' => Team::firstWhere('name', 'like', '%Cowboys')->id
        ]);
        // game 1
        factory('App\Game')->create([
            'season_id' => 1,
            'starts_at' => Carbon::create('2020', '09', '14', '18', '10'),
            'spread' => 0,
            'home_team_id' => Team::firstWhere('name', 'like', '%Giants')->id,
            'away_team_id' => Team::firstWhere('name', 'like', '%Steelers')->id
        ]);
        factory('App\Game')->create([
            'season_id' => 1,
            'starts_at' => Carbon::create('2020', '09', '14', '21', '20'),
            'spread' => 0,
            'home_team_id' => Team::firstWhere('name', 'like', '%Broncos')->id,
            'away_team_id' => Team::firstWhere('name', 'like', '%Titans')->id
        ]);
    }
}
