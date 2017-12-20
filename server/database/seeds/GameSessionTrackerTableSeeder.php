<?php

use Illuminate\Database\Seeder;

class GameSessionTrackerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\GameSessionTracker::class, 50)->create();
    }
}
