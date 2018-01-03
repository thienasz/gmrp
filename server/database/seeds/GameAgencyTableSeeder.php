<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameAgencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\GameAgency::class, 5)->create();
    }
}
