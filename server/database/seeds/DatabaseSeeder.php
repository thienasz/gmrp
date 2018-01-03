<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AgencyTableSeeder::class);
        $this->call(PaymentTypeTableSeeder::class);
        $this->call(GameTableSeeder::class);
        $this->call(GameAgencyTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(UserDetailsSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(PaymentTableSeeder::class);
        $this->call(GameSessionTrackerTableSeeder::class);
    }
}
