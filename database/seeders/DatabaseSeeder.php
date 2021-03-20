<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Database\Seeders\SportsTeamSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment(['local'])) {
            User::factory()->create([
                'name'=>'John Lieb-Bauman',
                'email'=>'jbaum012@gmail.com',
            ]);
        }
        $this->call([
            SportsTeamSeeder::class
        ]);
    }
}
