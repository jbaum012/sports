<?php

namespace Database\Seeders;

use App\Models\GameGroup;
use Illuminate\Database\Seeder;

class GameGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (GameGroup::count() > 0) {
            return;
        }
        $weeks = 18;
        for ($i = 1; $i <= $weeks; $i++) {
            GameGroup::factory()->create([
                'label' => "Week {$i}"
            ]);
        }
    }
}
