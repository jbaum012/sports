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
        $teams['Arizona Cardinals'] = ['#97233F', '#FFB612', 'Cardinals'];
        $teams['Atlanta Falcons'] = ['#A71930', '#000000', 'Falcons'];
        $teams['Baltimore Ravens'] = ['#241773', '#000000', 'Ravens'];
        $teams['Buffalo Bills'] = ['#00338D', '#C60C30', 'Bills'];
        $teams['Carolina Panthers'] = ['#0085CA', '#101820', 'Panthers'];
        $teams['Chicago Bears'] = ['#0B162A', '#C83803', 'Bears'];
        $teams['Cincinnati Bengals'] = ['#FB4F14', '#000000', 'Bengals'];
        $teams['Cleveland Browns'] = ['#311D00', '#FF3C00', "Browns"];
        $teams['Dallas Cowboys'] = ['#041E42', '#869397', 'Cowboys'];
        $teams['Denver Broncos'] = ['#FB4F14', '#002244', 'Broncos'];
        $teams['Detroit Lions'] = ['#0076B6', '#B0B7BC', 'Lions'];
        $teams['Green Bay Packers'] = ['#203731', '#FFB612', 'Packers'];
        $teams['Houston Texans'] = ['#03202F', '#A71930', 'Texans'];
        $teams['Indianapolis Colts'] = ['#002C5F', '#A2AAAD', 'Colts'];
        $teams['Jacksonville Jaguars'] = ['#006778', '#9F792C', 'Jaguars'];
        $teams['Kansas City Chiefs'] = ['#E31837', '#FFB81C', 'Chiefs'];
        $teams['Los Angeles Chargers'] = ['#002A5E', '#FFC20E', 'Chargers'];
        $teams['Los Angeles Rams'] = ['#003594', '#FFA300', 'Rams'];
        $teams['Miami Dolphins'] = ['#008E97', '#FC4C02', 'Dolphins'];
        $teams['Minnesota Vikings'] = ['#4F2683', '#FFC62F', 'Vikings'];
        $teams['New England Patriots'] = ['#002244', '#002244', 'Patriots'];
        $teams['New Orleans Saints'] = ['#D3BC8D', '#101820', 'Saints'];
        $teams['New York Giants'] = ['#0B2265', '#A71930', 'Giants'];
        $teams['New York Jets'] = ['#125740', '#FFFFFF', 'Jets'];
        $teams['Oakland Raiders'] = ['#000000', '#A5ACAF', 'Raiders'];
        $teams['Philadelphia Eagles'] = ['#004C54', '#A5ACAF', 'Eagles'];
        $teams['Pittsburgh Steelers'] = ['#101820', '#FFB612', 'Steelers'];
        $teams['San Francisco 49ers'] = ['#AA0000', '#B3995D', '49ers'];
        $teams['Seattle Seahawks'] = ['#002244', '#69BE28', 'Seahawks'];
        $teams['Tampa Bay Buccaneers'] = ['#D50A0A', '#FF7900', 'Buccaneers'];
        $teams['Tennessee Titans'] = ['#0C2340', '#4B92DB', 'Titans'];
        $teams['Washington Football Team'] = ['#773141', '#FFB612', 'Washington'];
        foreach ($teams as $team => $data) {
            factory('App\Team')->create([
                'name' => $team,
                'nickname' => $data[2],
                'primary_color' => $data[0],
                'secondary_color' => $data[1]
            ]);
        }
    }
}
