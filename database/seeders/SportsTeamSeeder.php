<?php

namespace Database\Seeders;

use App\Models\SportsTeam;
use Illuminate\Database\Seeder;

class SportsTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = [];
        $teams['Arizona Cardinals'] = ['#97233F', '#FFB612', 'Cardinals', 'Arizona', 'ARZ'];
        $teams['Atlanta Falcons'] = ['#A71930', '#000000', 'Falcons', 'Atlanta', 'ATL'];
        $teams['Baltimore  Ravens'] = ['#241773', '#000000', 'Ravens', "Baltimore", 'BLT'];
        $teams['Buffalo  Bills'] = ['#00338D', '#C60C30', 'Bills', "Buffalo", 'BUF'];
        $teams['Carolina  Panthers'] = ['#0085CA', '#101820', 'Panthers', "Carolina", "CAR"];
        $teams['Chicago  Bears'] = ['#0B162A', '#C83803', 'Bears', "Chicago", 'CHI'];
        $teams['Cincinnati  Bengals'] = ['#FB4F14', '#000000', 'Bengals', "Cincinnati", 'CIN'];
        $teams['Cleveland  Browns'] = ['#311D00', '#FF3C00', "Browns", "Cleveland", "CLV"];
        $teams['Dallas  Cowboys'] = ['#041E42', '#869397', 'Cowboys', "Dallas", 'DAL'];
        $teams['Denver  Broncos'] = ['#FB4F14', '#002244', 'Broncos', "Denver", "DEN"];
        $teams['Detroit Lions'] = ['#0076B6', '#B0B7BC', 'Lions', 'Detroit', 'DET'];
        $teams['Green Bay Packers'] = ['#203731', '#FFB612', 'Packers', 'Green Bay', 'GB'];
        $teams['Houston Texans'] = ['#03202F', '#A71930', 'Texans', 'Houston', 'HST'];
        $teams['Indianapolis Colts'] = ['#002C5F', '#A2AAAD', 'Colts', 'Indianapolis', 'IND'];
        $teams['Jacksonville Jaguars'] = ['#006778', '#9F792C', 'Jaguars', 'Jacksonville', 'JAX'];
        $teams['Kansas City Chiefs'] = ['#E31837', '#FFB81C', 'Chiefs', 'Kansas City', "KC"];
        $teams['Los Angeles Chargers'] = ['#002A5E', '#FFC20E', 'Chargers', 'Los Angeles', "LAC"];
        $teams['Los Angeles Rams'] = ['#003594', '#FFA300', 'Rams', 'Los Angeles', 'LAR'];
        $teams['Miami Dolphins'] = ['#008E97', '#FC4C02', 'Dolphins', 'Miami', 'MIA'];
        $teams['Minnesota Vikings'] = ['#4F2683', '#FFC62F', 'Vikings', 'Minnesota', 'MIN'];
        $teams['New England Patriots'] = ['#002244', '#002244', 'Patriots', 'New England', 'NE'];
        $teams['New Orleans Saints'] = ['#D3BC8D', '#101820', 'Saints', 'New Orleans', "NO"];
        $teams['New York Giants'] = ['#0B2265', '#A71930', 'Giants', 'New York', 'NYG'];
        $teams['New York Jets'] = ['#125740', '#FFFFFF', 'Jets', 'New York', 'NYJ'];
        $teams['Oakland Raiders'] = ['#000000', '#A5ACAF', 'Raiders', 'Las Vegas', 'LV'];
        $teams['Philadelphia Eagles'] = ['#004C54', '#A5ACAF', 'Eagles', 'Philadelphia', 'PHI'];
        $teams['Pittsburgh Steelers'] = ['#101820', '#FFB612', 'Steelers', 'Pittsburgh', 'PIT'];
        $teams['San Francisco 49ers'] = ['#AA0000', '#B3995D', '49ers', 'San Francisco', "SF"];
        $teams['Seattle Seahawks'] = ['#002244', '#69BE28', 'Seahawks', 'Seattle', "SEA"];
        $teams['Tampa Bay Buccaneers'] = ['#D50A0A', '#FF7900', 'Buccaneers', 'Tampa Bay', 'TB'];
        $teams['Tennessee Titans'] = ['#0C2340', '#4B92DB', 'Titans', 'Tennessee', 'TEN'];
        $teams['Washington Football Team'] = ['#773141', '#FFB612', 'Washington', 'Washington', 'WAS'];
        foreach ($teams as $team => $data) {
            SportsTeam::factory()->create([
                'primary_color' => $data[0],
                'secondary_color' => $data[1],
                'name' => $data[2],
                'location' => $data[3],
                'abbreviation' => $data[4]
            ]);
        }
    }
}
