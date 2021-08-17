<?php

namespace Database\Seeders;

use App\Models\SportsTeam;
use Illuminate\Database\Seeder;

class SportsTeamsSeeder extends Seeder
{
    const NFC_NORTH = 'NFC North';
    const NFC_SOUTH = 'NFC South';
    const NFC_EAST = 'NFC East';
    const NFC_WEST = 'NFC West';
    const AFC_NORTH = 'AFC North';
    const AFC_SOUTH = 'AFC South';
    const AFC_EAST = 'AFC East';
    const AFC_WEST = 'AFC West';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = [];
        $teams['Arizona Cardinals'] = ['#97233F', '#FFB612', 'Cardinals', 'Arizona', 'ARZ', $this::NFC_WEST];
        $teams['Atlanta Falcons'] = ['#A71930', '#000000', 'Falcons', 'Atlanta', 'ATL', $this::NFC_SOUTH];
        $teams['Baltimore  Ravens'] = ['#241773', '#000000', 'Ravens', "Baltimore", 'BLT', $this::AFC_NORTH];
        $teams['Buffalo  Bills'] = ['#00338D', '#C60C30', 'Bills', "Buffalo", 'BUF', $this::AFC_EAST];
        $teams['Carolina  Panthers'] = ['#0085CA', '#101820', 'Panthers', "Carolina", "CAR", $this::NFC_SOUTH];
        $teams['Chicago  Bears'] = ['#0B162A', '#C83803', 'Bears', "Chicago", 'CHI', $this::NFC_NORTH];
        $teams['Cincinnati  Bengals'] = ['#FB4F14', '#000000', 'Bengals', "Cincinnati", 'CIN', $this::AFC_NORTH];
        $teams['Cleveland  Browns'] = ['#311D00', '#FF3C00', "Browns", "Cleveland", "CLV", $this::AFC_NORTH];
        $teams['Dallas  Cowboys'] = ['#041E42', '#869397', 'Cowboys', "Dallas", 'DAL', $this::NFC_EAST];
        $teams['Denver  Broncos'] = ['#FB4F14', '#002244', 'Broncos', "Denver", "DEN", $this::AFC_WEST];
        $teams['Detroit Lions'] = ['#0076B6', '#B0B7BC', 'Lions', 'Detroit', 'DET', $this::NFC_NORTH];
        $teams['Green Bay Packers'] = ['#203731', '#FFB612', 'Packers', 'Green Bay', 'GB', $this::NFC_NORTH];
        $teams['Houston Texans'] = ['#03202F', '#A71930', 'Texans', 'Houston', 'HST', $this::AFC_SOUTH];
        $teams['Indianapolis Colts'] = ['#002C5F', '#A2AAAD', 'Colts', 'Indianapolis', 'IND', $this::AFC_SOUTH];
        $teams['Jacksonville Jaguars'] = ['#006778', '#9F792C', 'Jaguars', 'Jacksonville', 'JAX', $this::AFC_SOUTH];
        $teams['Kansas City Chiefs'] = ['#E31837', '#FFB81C', 'Chiefs', 'Kansas City', "KC", $this::AFC_WEST];
        $teams['Los Angeles Chargers'] = ['#002A5E', '#FFC20E', 'Chargers', 'Los Angeles', "LAC", $this::AFC_WEST];
        $teams['Los Angeles Rams'] = ['#003594', '#FFA300', 'Rams', 'Los Angeles', 'LAR', $this::NFC_WEST];
        $teams['Miami Dolphins'] = ['#008E97', '#FC4C02', 'Dolphins', 'Miami', 'MIA', $this::AFC_EAST];
        $teams['Minnesota Vikings'] = ['#4F2683', '#FFC62F', 'Vikings', 'Minnesota', 'MIN', $this::NFC_NORTH];
        $teams['New England Patriots'] = ['#002244', '#C60C30', 'Patriots', 'New England', 'NE', $this::AFC_EAST];
        $teams['New Orleans Saints'] = ['#D3BC8D', '#101820', 'Saints', 'New Orleans', "NO", $this::NFC_SOUTH];
        $teams['New York Giants'] = ['#0B2265', '#A71930', 'Giants', 'New York', 'NYG', $this::NFC_EAST];
        $teams['New York Jets'] = ['#125740', '#FFFFFF', 'Jets', 'New York', 'NYJ', $this::AFC_EAST];
        $teams['Oakland Raiders'] = ['#000000', '#A5ACAF', 'Raiders', 'Las Vegas', 'LV', $this::AFC_WEST];
        $teams['Philadelphia Eagles'] = ['#004C54', '#A5ACAF', 'Eagles', 'Philadelphia', 'PHI', $this::NFC_EAST];
        $teams['Pittsburgh Steelers'] = ['#101820', '#FFB612', 'Steelers', 'Pittsburgh', 'PIT', $this::AFC_NORTH];
        $teams['San Francisco 49ers'] = ['#AA0000', '#B3995D', '49ers', 'San Francisco', "SF", $this::NFC_WEST];
        $teams['Seattle Seahawks'] = ['#002244', '#69BE28', 'Seahawks', 'Seattle', "SEA", $this::NFC_WEST];
        $teams['Tampa Bay Buccaneers'] = ['#D50A0A', '#FF7900', 'Buccaneers', 'Tampa Bay', 'TB', $this::NFC_SOUTH];
        $teams['Tennessee Titans'] = ['#0C2340', '#4B92DB', 'Titans', 'Tennessee', 'TEN', $this::AFC_SOUTH];
        $teams['Washington Football Team'] = ['#773141', '#FFB612', 'Washington', 'Washington', 'WAS', $this::NFC_EAST];
        foreach ($teams as $team => $data) {
            SportsTeam::factory()->create([
                'primary_color' => $data[0],
                'secondary_color' => $data[1],
                'name' => $data[2],
                'location' => $data[3],
                'abbreviation' => $data[4],
                'division' => $data[5]
            ]);
        }
    }
}
