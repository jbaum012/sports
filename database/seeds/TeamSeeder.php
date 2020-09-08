<?php

use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = [];
        $teams['Arizona Cardinals'] = ['#97233F', '#FFB612'];
        $teams['Atlanta Falcons'] = ['#A71930', '#000000'];
        $teams['Baltimore Ravens'] = ['#241773', '#000000'];
        $teams['Buffalo Bills'] = ['#00338D', '#C60C30'];
        $teams['Carolina Panthers'] = ['#0085CA', '#101820'];
        $teams['Chicago Bears'] = ['#0B162A', '#C83803'];
        $teams['Cincinnati Bengals'] = ['#FB4F14', '#000000'];
        $teams['Cleveland Browns'] = ['#311D00', '#FF3C00'];
        $teams['Dallas Cowboys'] = ['#041E42', '#869397'];
        $teams['Denver Broncos'] = ['#FB4F14', '#002244'];
        $teams['Detroit Lions'] = ['#0076B6', '#B0B7BC'];
        $teams['Green Bay Packers'] = ['#203731', '#FFB612'];
        $teams['Houston Texans'] = ['#03202F', '#A71930'];
        $teams['Indianapolis Colts'] = ['#002C5F', '#A2AAAD'];
        $teams['Jacksonville Jaguars'] = ['#006778', '#9F792C'];
        $teams['Kansas City Chiefs'] = ['#E31837', '#FFB81C'];
        $teams['Los Angeles Chargers'] = ['#002A5E', '#FFC20E'];
        $teams['Los Angeles Rams'] = ['#003594', '#FFA300'];
        $teams['Miami Dolphins'] = ['#008E97', '#FC4C02'];
        $teams['Minnesota Vikings'] = ['#4F2683', '#FFC62F'];
        $teams['New England Patriots'] = ['#002244', '#002244'];
        $teams['New Orleans Saints'] = ['#D3BC8D', '#101820'];
        $teams['New York Giants'] = ['#0B2265', '#A71930'];
        $teams['New York Jets'] = ['#125740', '#FFFFFF'];
        $teams['Oakland Raiders'] = ['#000000', '#A5ACAF'];
        $teams['Philadelphia Eagles'] = ['#004C54', '#A5ACAF'];
        $teams['Pittsburgh Steelers'] = ['#101820', '#FFB612'];
        $teams['San Francisco 49ers'] = ['#AA0000', '#B3995D'];
        $teams['Seattle Seahawks'] = ['#002244', '#69BE28'];
        $teams['Tampa Bay Buccaneers'] = ['#D50A0A', '#FF7900'];
        $teams['Tennessee Titans'] = ['#0C2340', '#4B92DB'];
        $teams['Washington Football Team'] = ['#773141', '#FFB612'];
        foreach ($teams as $team => $colors) {
            factory('App\Team')->create([
                'name' => $team,
                'primary_color' => $colors[0],
                'secondary_color' => $colors[1]
            ]);
        }
    }
}
