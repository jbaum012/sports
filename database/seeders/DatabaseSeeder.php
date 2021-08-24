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
            $localUser = User::firstOrCreate([
                'name'=>'John Lieb-Bauman',
                'email'=>'jbaum012@gmail.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ]);

            $this->call([
                SportsGameSeeder::class
            ]);
        }
    }
}
