<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    use RefreshDatabase;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SportsTeamsSeeder::class,
            GameGroupSeeder::class,
            SportsBetSeeder::class,
        ]);

        if (App::environment(['local'])) {
            if (! User::where('name', 'John Lieb-Bauman')->get()) {
                User::factory()->create([
                    'name'=>'John Lieb-Bauman',
                    'email'=>'jbaum012@gmail.com',
                ]);
            }

            $this->call([
                SportsGameSeeder::class
            ]);
        }
    }
}
