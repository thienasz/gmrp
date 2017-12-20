<?php

use Illuminate\Database\Seeder;

class NewRegisterTrackerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\NewRegisterTracker::class, 50)->create();
    }
}
